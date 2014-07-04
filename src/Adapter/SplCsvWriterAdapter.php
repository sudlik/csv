<?php

namespace Csv\Adapter;

use Csv\Exception\InvalidCsvRowException;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
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
      */
    public function __construct(SplFileObject $file, Delimiter $delimiter, Enclosure $enclosure)
    {
        $this->file = $file;
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
    }

    /**
     * @param string $row
     * @throws Csv\Exception\InvalidCsvRowException
     * @return self
     */
    public function write(array $row)
    {
        if ($this->isRow($row)) {
            $this->file->fputcsv($row, $this->delimiter->getValue(), $this->enclosure->getValue());
        } else {
            throw new InvalidCsvRowException;
        }

        return $this;
    }

    private function isRow($row)
    {
        if (is_array($row)) {
            foreach ($row as $cell) {
                if (!is_scalar($cell) && !is_null($cell)) {
                    return false;
                }
            }

            return true;
        } else {
            return false;
        }
    }
}
