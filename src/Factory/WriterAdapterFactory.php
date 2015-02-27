<?php

namespace Csv\Factory;

use Csv\Adapter\WriterAdapter;
use Csv\Collection\ColumnCollection;
use Csv\Value\FilePath;
use Csv\Value\WriterConfig;

interface WriterAdapterFactory
{
    /**
     * @param WriterConfig $writerConfig
     * @param FilePath $filePath
     * @param ColumnCollection $columns
     * @return WriterAdapter
     */
    public function createWithConfigs(WriterConfig $writerConfig, FilePath $filePath, ColumnCollection $columns);
}
