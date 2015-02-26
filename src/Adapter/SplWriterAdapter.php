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
    /**
     * @var SplFileObject
     */
    private $splFileObject;

    /**
     * @param SplFileObject $splFileObject
     */
    public function __construct(SplFileObject $splFileObject)
    {
        $this->splFileObject = $splFileObject;
    }

    /**
     * @param string $string
     * @throws \Csv\Exception\UnexpectedArgumentTypeException if argument is not a string
     * @return self
     */
    public function writeString($string)
    {
        if (is_string($string)) {
            $this->splFileObject->fwrite($string);
            $this->splFileObject->fflush();
        } else {
            throw new UnexpectedArgumentTypeException;
        }

        return $this;
    }

    /**
     * @param Delimiter $delimiter
     * @param Enclosure $enclosure
     * @param array $array
     * @return self
     */
    public function writeArray(Delimiter $delimiter, Enclosure $enclosure, array $array)
    {
        $this->splFileObject->fputcsv($array, $delimiter->getValue(), $enclosure->getValue());
        $this->splFileObject->fflush();

        return $this;
    }
}
