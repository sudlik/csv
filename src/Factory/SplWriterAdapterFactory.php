<?php

namespace Csv\Factory;

use Csv\Adapter\SplWriterAdapter;
use Csv\Collection\NamedWritableColumnCollection;
use Csv\Value\FilePath;
use Csv\Value\WriterConfig;

class SplWriterAdapterFactory implements WriterAdapterFactory
{
    private $fileFactory;
    private $validatorFactory;

    public function __construct(SplFileObjectFromPathAndModeFactory $file, ValuesValidatorFromColumnsFactory $validator)
    {
        $this->fileFactory = $file;
        $this->validatorFactory = $validator;
    }

    public function createFormConfigPathAndColumns(
        WriterConfig $config,
        FilePath $filePath,
        NamedWritableColumnCollection $columns
    ) {
        return new SplWriterAdapter(
            $this->fileFactory->createFromPathAndMode($filePath, $config->getContentConfig()->getWriteMode()),
            $this->validatorFactory->createFromColumns($columns),
            $config,
            $columns
        );
    }
}
