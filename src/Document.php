<?php

namespace Csv;

use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;

class Document
{
    private $csvConfig;
    private $fileConfig;
    private $table;

    public function __construct(CsvConfig $csvConfig, FileConfig $fileConfig, Table $table)
    {
        $this->csvConfig = $csvConfig;
        $this->fileConfig = $fileConfig;
        $this->table = clone $table;

        $this->table->freeze();
    }

    public function getCsvConfig()
    {
        return $this->csvConfig;
    }

    public function getFileConfig()
    {
        return $this->fileConfig;
    }

    public function getTable()
    {
        return $this->table;
    }
}
