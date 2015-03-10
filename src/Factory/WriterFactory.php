<?php

namespace Csv\Factory;

use Csv\Writer\Writer;
use Csv\Collection\NamedWritableColumnCollection;
use Csv\Value\FilePath;
use Csv\Value\WriterConfig;

interface WriterFactory
{
    /**
     * @param WriterConfig $config
     * @param FilePath $file
     * @param NamedWritableColumnCollection $columns
     * @return Writer
     */
    public function createNative(WriterConfig $config, FilePath $file, NamedWritableColumnCollection $columns);

    /**
     * @param WriterConfig $config
     * @param FilePath $file
     * @param NamedWritableColumnCollection $columns
     * @return Writer
     */
    public function createExtended(WriterConfig $config, FilePath $file, NamedWritableColumnCollection $columns);
}
