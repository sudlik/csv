<?php

namespace Csv;

use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;

/**
 * Class Document
 * @package Csv
 */
class Document
{
    /**
     * @var Value\CsvConfig
     */
    private $csvConfig;

    /**
     * @var Value\FileConfig
     */
    private $fileConfig;

    /**
     * @var Table
     */
    private $table;

    /**
     * @param CsvConfig $csvConfig
     * @param FileConfig $fileConfig
     * @param Table $table
     */
    public function __construct(CsvConfig $csvConfig, FileConfig $fileConfig, Table $table)
    {
        $this->csvConfig = $csvConfig;
        $this->fileConfig = $fileConfig;
        $this->table = clone $table;

        $this->table->freeze();
    }

    /**
     * @return CsvConfig
     */
    public function getCsvConfig()
    {
        return $this->csvConfig;
    }

    /**
     * @return FileConfig
     */
    public function getFileConfig()
    {
        return $this->fileConfig;
    }

    /**
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }
}
