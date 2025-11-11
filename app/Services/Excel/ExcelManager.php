<?php

namespace App\Services\Excel;

use Closure;

class ExcelManager
{
    public function create(string $fileName, Closure $callback): LegacyExcelWriter
    {
        $writer = new LegacyExcelWriter($fileName);
        $callback($writer);

        return $writer;
    }

    public function load(string $path, ?Closure $callback = null): LegacyExcelReader
    {
        return new LegacyExcelReader($path, $callback);
    }
}
