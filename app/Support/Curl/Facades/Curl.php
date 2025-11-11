<?php

namespace Ixudra\Curl\Facades;

use Illuminate\Support\Facades\Facade;

class Curl extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'curl';
    }
}
