<?php

namespace Csv\Value;

use ValueObjects\ValueObjectInterface;

final class WriterConfig implements ValueObjectInterface
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

    public function __toString()
    {
        return self::class . '(' . $this->csvConfig . ', ' . $this->contentConfig . ')';
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $object instanceof self
            and $this->csvConfig->sameValueAs($object->getCsvConfig())
            and $this->contentConfig->sameValueAs($object->getContentConfig());
    }
}
