<?php

namespace Csv;

use Csv\Collection\Row;
use Csv\Collection\RowCollection;
use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;

class Document
{
    private $csvConfig;
    private $fileConfig;
    private $names;
    private $data;
    
    public function __construct(CsvConfig $csvConfig, FileConfig $fileConfig, Row $names, RowCollection $data)
    {
        $this->csvConfig = $csvConfig;
        $this->fileConfig = $fileConfig;
        $this->names = clone $names;
        $this->data = clone $data;

        $this->names->freeze();
        $this->data->freeze();

        foreach ($this->data->all() as $row) {
            $row->freeze();
        }
    }
    
    public function getCsvConfig()
    {
        return $this->csvConfig;
    }
    
    public function getFileConfig()
    {
        return $this->fileConfig;
    }
    
    public function getNames()
    {
        return $this->names;
    }
    
    public function getData()
    {
        return $this->data;
    }
}