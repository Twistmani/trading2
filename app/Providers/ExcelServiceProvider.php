<?php

namespace App\Providers;

use App\Services\Excel\ExcelManager;
use Illuminate\Support\ServiceProvider;

class ExcelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ExcelManager::class, fn () => new ExcelManager());
        $this->app->alias(ExcelManager::class, 'excel');
    }
}
