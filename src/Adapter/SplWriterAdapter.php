<?php

namespace Csv\Adapter;

use Csv\Collection\Row;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Exception\UnexpectedArgumentTypeException;
use SplFileObject;

/**
 * @package Csv
 */
class SplWriterAdapter implements WriterAdapter
{
    private $splFileObject;

    public function __construct(SplFileObject $splFileObject)
    {
        $this->splFileObject = $splFileObject;
    }

    /**
     * @param Row $row
     * @return self
     */
    public function writeRow(Delimiter $delimiter, Enclosure $enclosure, Row $row)
    {
        $this->splFileObject->fputcsv($row->asArray(), $delimiter->getValue(), $enclosure->getValue());

        return $this;
    }

    /**
     * @param string $string
     * @throws Csv\Exception\UnexpectedArgumentTypeException if argument is not string
     * @return self
     */
    public function writeString($string)
    {
        if (is_string($string)) {
            $this->splFileObject->fwrite($string);
        } else {
            throw new UnexpectedArgumentTypeException;
        }

        return $this;
    }
}
