<?php

namespace Csv\Factory;

use Csv\Adapter\SplWriterAdapter;
use Csv\Collection\ColumnCollection;
use Csv\Value\FilePath;
use Csv\Value\WriterConfig;

class SplWriterAdapterFactory implements WriterAdapterFactory
{
    private $splFileFactory;
    private $validatorFactory;

    public function __construct(SplFileObjectFactory $splFileFactory, ValuesValidatorFactory $validatorFactory)
    {
        $this->splFileFactory = $splFileFactory;
        $this->validatorFactory = $validatorFactory;
    }

    public function createWithConfigs(WriterConfig $writerConfig, FilePath $filePath, ColumnCollection $columns)
    {
        return new SplWriterAdapter(
            $this->splFileFactory->create($filePath, $writerConfig->getContentConfig()->getWriteMode()),
            $this->validatorFactory->createWithColumnCollection($columns),
            $writerConfig,
            $columns
        );
    }
}
