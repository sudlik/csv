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
class SplCsvWriterAdapter implements CsvWriterAdapterInterface
{
    /**
     * @var SplFileObject
     */
    private $file;

    /**
     * @var Delimiter
     */
    private $delimiter;

    /**
     * @var Enclosure
     */
    private $enclosure;

     /**
      * @param SplFileObject $file required, adapted object
      * @param Delimiter $delimiter required
      * @param Enclosure $enclosure required
      */
    public function __construct(SplFileObject $file, Delimiter $delimiter, Enclosure $enclosure)
    {
        $this->file = $file;
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
    }

    /**
     * @param Row $row
     * @return self
     */
    public function writeRow(Row $row)
    {
        $this->file->fputcsv($row->asArray(), $this->delimiter->getValue(), $this->enclosure->getValue());

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
            $this->file->fwrite($string);
        } else {
            throw new UnexpectedArgumentTypeException;
        }

        return $this;
    }
}
