<?php

namespace App\Services\Excel;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LegacyExcelSheet
{
    private Worksheet $worksheet;

    private bool $autoSize = false;

    public function __construct(Worksheet $worksheet)
    {
        $this->worksheet = $worksheet;
    }

    public function fromArray(
        array $source,
        $nullValue = null,
        string $startCell = 'A1',
        bool $strictNullComparison = false,
        bool $calculateFormulas = false
    ): self
    {
        $this->worksheet->fromArray($source, $nullValue, $startCell, $strictNullComparison);

        return $this;
    }

    public function row(int $row, array $values): self
    {
        $this->worksheet->fromArray([$values], null, 'A' . $row);

        return $this;
    }

    public function mergeCells(string $range): self
    {
        $this->worksheet->mergeCells($range);

        return $this;
    }

    public function setAutoSize(bool $autoSize = true): self
    {
        $this->autoSize = $autoSize;

        return $this;
    }

    public function finalize(): void
    {
        if (! $this->autoSize) {
            return;
        }

        $highestColumn = $this->worksheet->getHighestColumn();
        $columnCount = Coordinate::columnIndexFromString($highestColumn);

        for ($index = 1; $index <= $columnCount; $index++) {
            $column = Coordinate::stringFromColumnIndex($index);
            $this->worksheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
