<?php

namespace Csv\Adapter;

use Csv\Collection\Row;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use SplFileObject;

/**
 * @package Csv
 */
interface WriterAdapter
{
    /**
     * @param Row $row
     * @return self
     */
    public function writeRow(Delimiter $delimiter, Enclosure $enclosure, Row $row);

    /**
     * @param string $string
     * @throws Csv\Exception\UnexpectedArgumentTypeException if argument is not string
     * @return self
     */
    public function writeString($string);
}
