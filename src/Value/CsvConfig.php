<?php

namespace Csv\Value;

final class CsvConfig
{
    private $delimiter;
    private $enclosure;
    private $escape;

    public function __construct(Delimiter $delimiter, EnclosureConfig $enclosure, Escape $escape)
    {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
    }

    public function getDelimiter()
    {
        return $this->delimiter;
    }

    public function getEnclosure()
    {
        return $this->enclosure;
    }

    public function getEscape()
    {
        return $this->escape;
    }
}
