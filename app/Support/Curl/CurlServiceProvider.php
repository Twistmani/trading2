<?php

namespace Ixudra\Curl;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Client\Factory as HttpFactory;

class CurlServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('curl', function ($app) {
            return new CurlManager($app->make(HttpFactory::class));
        });
    }
}
