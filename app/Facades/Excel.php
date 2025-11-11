<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Excel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'excel';
    }
}
