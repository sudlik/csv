<?php

namespace Csv\Factory;

use Csv\Adapter\SplWriterAdapter;
use Csv\Collection\NamedWritableColumnCollection;
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

    public function createWithConfigs(WriterConfig $config, FilePath $filePath, NamedWritableColumnCollection $columns)
    {
        return new SplWriterAdapter(
            $this->splFileFactory->create($filePath, $config->getContentConfig()->getWriteMode()),
            $this->validatorFactory->createWithColumnCollection($columns),
            $config,
            $columns
        );
    }
}
