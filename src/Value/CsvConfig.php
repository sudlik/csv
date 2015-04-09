<?php

namespace Csv\Value;

final class CsvConfig
{
    private $delimiter;
    private $enclosure;
    private $escape;

    public static function standard()
    {
        return new self(Delimiter::COMMA(), EnclosureConfig::standard(), Escape::BACKSLASH());
    }

    public static function withDelimiterAndEnclosure(Delimiter $delimiter, EnclosureCharacter $enclosure)
    {
        return new self($delimiter, EnclosureConfig::withCharacter($enclosure), Escape::BACKSLASH());
    }

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
