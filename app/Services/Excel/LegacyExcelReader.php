<?php

namespace App\Services\Excel;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LegacyExcelReader
{
    private string $path;

    private ?Closure $callback;

    public function __construct(string $path, ?Closure $callback)
    {
        $this->path = $path;
        $this->callback = $callback;
    }

    public function get(): Collection
    {
        $spreadsheet = IOFactory::load($this->path);

        if ($this->callback) {
            ($this->callback)($spreadsheet);
        }

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray(null, true, true, true);

        if (empty($rows)) {
            return collect();
        }

        $headers = array_shift($rows);
        $normalized = [];

        foreach ($headers as $value) {
            if ($value === null || trim((string) $value) === '') {
                $normalized[] = null;
                continue;
            }

            $key = Str::slug((string) $value, '_');
            $normalized[] = $key !== '' ? $key : (string) $value;
        }

        $collection = collect();

        foreach ($rows as $row) {
            $record = new \stdClass();
            $hasValue = false;
            $index = 0;

            foreach ($row as $cell) {
                $header = $normalized[$index] ?? null;
                $index++;

                if ($header === null) {
                    continue;
                }

                $record->{$header} = $cell;
                if ($cell !== null && $cell !== '') {
                    $hasValue = true;
                }
            }

            if ($hasValue) {
                $collection->push($record);
            }
        }

        return $collection;
    }
}
