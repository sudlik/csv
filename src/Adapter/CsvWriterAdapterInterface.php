<?php

namespace Csv\Adapter;

/**
 * @package Csv
 */
interface CsvWriterAdapterInterface
{
    /**
     * @path string $row
     * @return self
     */
    public function write(array $row);
}