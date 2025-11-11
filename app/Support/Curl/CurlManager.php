<?php

namespace Ixudra\Curl;

use Illuminate\Http\Client\Factory as HttpFactory;

class CurlManager
{
    protected HttpFactory $factory;

    public function __construct(HttpFactory $factory)
    {
        $this->factory = $factory;
    }

    public function to(string $url): PendingCurlRequest
    {
        return new PendingCurlRequest($this->factory, $url);
    }
}
