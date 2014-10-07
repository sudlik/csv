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
     * @param string $string
     * @throws Csv\Exception\UnexpectedArgumentTypeException if argument is not string
     * @return self
     */
    public function writeString($string);

    /**
     * @param Delimiter $delimiter
     * @param Enclosure $enclosure
     * @param Row $row
     * @return self
     */
    public function writeRow(Delimiter $delimiter, Enclosure $enclosure, Row $row);

    /**
     * @param Delimiter $delimiter
     * @param Enclosure $enclosure
     * @param Row $row
     * @param int $position
     * @return self
     */
    public function overwriteRow(Delimiter $delimiter, Enclosure $enclosure, Row $row, $position);

    /**
     * @param Delimiter $delimiter
     * @param Enclosure $enclosure
     * @param array $array
     * @return self
     */
    public function writeArray(Delimiter $delimiter, Enclosure $enclosure, array $array);
}
