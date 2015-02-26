<?php

namespace Csv\Adapter;

use Csv\Collection\Row;
use Csv\Value\Delimiter;
use Csv\Value\Enclosure;
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
     * @param array $array
     * @return self
     */
    public function writeArray(Delimiter $delimiter, Enclosure $enclosure, array $array);
}
