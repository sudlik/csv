<?php

namespace Csv;

use Csv\Collection\Row;
use Csv\Collection\RowCollection;
use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;
use Csv\Writer\DocumentWriter;

class Document
{
    private $csvConfig;
    private $documentWriter;
    private $fileConfig;
    private $names;
    private $rowCollection;
    
    public function __construct(
        CsvConfig $csvConfig,
        FileConfig $fileConfig,
        Row $names,
        RowCollection $rowCollection
    ) {
        $this->csvConfig = $csvConfig;
        $this->fileConfig = $fileConfig;
        $this->names = $names;
        $this->rowCollection = $rowCollection;
        $this->documentWriter = new DocumentWriter($csvConfig, $fileConfig);
    }
    
    public function getCsvConfig()
    {
        return $this->csvConfig;
    }
    
    public function getFileConfig()
    {
        return $this->fileConfig;
    }
    
    public function getDocumentWriter()
    {
        return $this->fileConfig;
    }
    
    public function getNames()
    {
        return $this->names;
    }
    
    public function getRowCollection()
    {
        return $this->rowCollection;
    }

    public function write()
    {
        $visibleNames = $this->getCsvConfig()->getVisibleNames()->getValue();

        if ($visibleNames) {
            $this->documentWriter->write($this->names, true);
        }

        foreach ($this->rowCollection->all() as $k => $row) {
            $this->documentWriter->write($row, $visibleNames and $k === 0);
        }
    }
}