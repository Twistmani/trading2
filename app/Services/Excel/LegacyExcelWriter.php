<?php

namespace App\Services\Excel;

use Closure;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LegacyExcelWriter
{
    private Spreadsheet $spreadsheet;

    private int $sheetIndex = 0;

    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->spreadsheet = new Spreadsheet();
    }

    public function setTitle(string $title): self
    {
        $this->spreadsheet->getProperties()->setTitle($title);

        return $this;
    }

    public function setCreator(string $creator): self
    {
        $this->spreadsheet->getProperties()->setCreator($creator);

        return $this;
    }

    public function setCompany(string $company): self
    {
        $this->spreadsheet->getProperties()->setCompany($company);

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->spreadsheet->getProperties()->setDescription($description);

        return $this;
    }

    public function sheet(string $title, Closure $callback): self
    {
        if ($this->sheetIndex === 0) {
            $worksheet = $this->spreadsheet->getActiveSheet();
            $worksheet->setTitle($title);
        } else {
            $worksheet = $this->spreadsheet->createSheet($this->sheetIndex);
            $worksheet->setTitle($title);
            $this->spreadsheet->setActiveSheetIndex($this->sheetIndex);
        }

        $sheet = new LegacyExcelSheet($worksheet);
        $callback($sheet);
        $sheet->finalize();

        $this->sheetIndex++;
        $this->spreadsheet->setActiveSheetIndex(0);

        return $this;
    }

    public function download(string $writerType = 'xlsx')
    {
        $extension = strtolower($writerType) === 'xls' ? 'xls' : 'xlsx';
        $writer = $extension === 'xls'
            ? new Xls($this->spreadsheet)
            : new Xlsx($this->spreadsheet);

        $contentType = $extension === 'xls'
            ? 'application/vnd.ms-excel'
            : 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

        return response()->streamDownload(
            fn () => $writer->save('php://output'),
            sprintf('%s.%s', $this->fileName, $extension),
            ['Content-Type' => $contentType]
        );
    }
}
