<?php

namespace Csv\Adapter;

use Csv\Collection\Row;

/**
 * @package Csv
 */
interface CsvWriterAdapterInterface
{
    /**
     * @param Row $row
     * @return self
     */
    public function writeRow(Row $row);

    /**
     * @param string $string
     * @throws Csv\Exception\UnexpectedArgumentTypeException if argument is not string
     * @return self
     */
    public function writeString($string);
}
