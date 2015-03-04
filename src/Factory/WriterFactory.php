<?php

namespace Csv\Factory;

use Csv\Writer\Writer;
use Csv\Collection\AssertableColumnCollection;
use Csv\Collection\NamedWritableColumnCollection;
use Csv\Value\FilePath;
use Csv\Value\WriterConfig;

interface WriterFactory
{
    /**
     * @param WriterConfig $config
     * @param FilePath $file
     * @param AssertableColumnCollection $columns
     * @return Writer
     */
    public function createValidCsv(WriterConfig $config, FilePath $file, AssertableColumnCollection $columns);

    /**
     * @param WriterConfig $config
     * @param FilePath $file
     * @param NamedWritableColumnCollection $columns
     * @return Writer
     */
    public function createNonValidCsv(WriterConfig $config, FilePath $file, NamedWritableColumnCollection $columns);
}
