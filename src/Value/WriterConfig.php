<?php

namespace Csv\Value;

final class WriterConfig
{
    private $csvConfig;
    private $contentConfig;

    public static function standard()
    {
        return new self(CsvConfig::standard(), ContentConfig::standard());
    }

    public static function withDelimiterAndEnclosure(Delimiter $delimiter, EnclosureCharacter $enclosure)
    {
        return new self(CsvConfig::withDelimiterAndEnclosure($delimiter, $enclosure), ContentConfig::standard());
    }

    public function __construct(CsvConfig $csvConfig, ContentConfig $contentConfig)
    {
        $this->csvConfig = $csvConfig;
        $this->contentConfig = $contentConfig;
    }

    public function getCsvConfig()
    {
        return $this->csvConfig;
    }

    public function getContentConfig()
    {
        return $this->contentConfig;
    }
}
