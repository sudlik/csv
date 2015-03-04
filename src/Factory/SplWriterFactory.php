<?php

namespace Csv\Factory;

use Csv\Writer\SplNonValidCsvWriter;
use Csv\Writer\SplValidCsvWriter;
use Csv\Collection\AssertableColumnCollection;
use Csv\Collection\NamedWritableColumnCollection;
use Csv\Value\FilePath;
use Csv\Value\WriterConfig;

class SplWriterFactory implements WriterFactory
{
    private $fileFactory;
    private $validatorFactory;

    public function __construct(SplFileObjectFromPathAndModeFactory $file, ValuesValidatorFromColumnsFactory $validator)
    {
        $this->fileFactory = $file;
        $this->validatorFactory = $validator;
    }

    public function createValidCsv(WriterConfig $config, FilePath $file, AssertableColumnCollection $columns)
    {
        return new SplValidCsvWriter(
            $this->fileFactory->createFromPathAndMode($file, $config->getContentConfig()->getWriteMode()),
            $this->validatorFactory->createFromColumns($columns),
            $config,
            $columns
        );
    }

    public function createNonValidCsv(WriterConfig $config, FilePath $file, NamedWritableColumnCollection $columns)
    {
        return new SplNonValidCsvWriter(
            $this->fileFactory->createFromPathAndMode($file, $config->getContentConfig()->getWriteMode()),
            $config,
            $columns
        );
    }
}
