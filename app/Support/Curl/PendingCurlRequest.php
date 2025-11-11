<?php

namespace Ixudra\Curl;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class PendingCurlRequest
{
    protected HttpFactory $factory;

    protected string $url;

    protected mixed $data = [];

    protected array $headers = [];

    protected bool $expectsJson = false;

    protected ?int $timeout = null;

    public function __construct(HttpFactory $factory, string $url)
    {
        $this->factory = $factory;
        $this->url = $url;
    }

    public function withData(mixed $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function withHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function withHeaders(array $headers): self
    {
        foreach ($headers as $name => $value) {
            $this->headers[$name] = $value;
        }

        return $this;
    }

    public function timeout(int $seconds): self
    {
        $this->timeout = $seconds;

        return $this;
    }

    public function asJson(): self
    {
        $this->expectsJson = true;

        return $this;
    }

    public function get(): mixed
    {
        return $this->send('get');
    }

    public function post(): mixed
    {
        return $this->send('post');
    }

    public function put(): mixed
    {
        return $this->send('put');
    }

    protected function send(string $method): mixed
    {
        $request = $this->prepareRequest($method);

        $payload = $this->preparePayload($method);

        $response = $request->{$method}($this->url, $payload);

        return $this->transformResponse($response);
    }

    protected function prepareRequest(string $method): PendingRequest
    {
        $request = $this->factory->withHeaders($this->headers);

        if ($this->timeout !== null) {
            $request = $request->timeout($this->timeout);
        }

        if ($this->expectsJson) {
            $request = $request->acceptJson()->asJson();
        } elseif ($method !== 'get') {
            $request = $request->asForm();
        }

        return $request;
    }

    protected function preparePayload(string $method): mixed
    {
        if ($method === 'get') {
            return is_array($this->data) ? $this->data : [];
        }

        return $this->data ?? [];
    }

    protected function transformResponse(Response $response): mixed
    {
        if ($this->expectsJson) {
            $decoded = json_decode($response->body());

            return $decoded ?? $response->body();
        }

        return $response->body();
    }
}
