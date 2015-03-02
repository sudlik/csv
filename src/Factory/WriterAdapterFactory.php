<?php

namespace Csv\Factory;

use Csv\Adapter\WriterAdapter;
use Csv\Collection\NamedWritableColumnCollection;
use Csv\Value\FilePath;
use Csv\Value\WriterConfig;

interface WriterAdapterFactory
{
    /**
     * @param WriterConfig $config
     * @param FilePath $filePath
     * @param NamedWritableColumnCollection $columns
     * @return WriterAdapter
     */
    public function createFormConfigPathAndColumns(
        WriterConfig $config,
        FilePath $filePath,
        NamedWritableColumnCollection $columns
    );
}
