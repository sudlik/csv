<?php

namespace Csv\Value;

final class WriterConfig
{
    private $csvConfig;
    private $contentConfig;

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
