<?php

namespace Csv\Value;

use ValueObjects\ValueObjectInterface;

final class CsvConfig implements ValueObjectInterface
{
    private $delimiter;
    private $enclosure;
    private $escape;

    public function __construct(Delimiter $delimiter, Enclosure $enclosure, Escape $escape)
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

    public function __toString()
    {
        return self::class . '(' . $this->delimiter . ', ' . $this->enclosure . ', ' . $this->escape . ')';
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $object instanceof self
            and $this->delimiter->sameValueAs($object->getDelimiter())
            and $this->enclosure->sameValueAs($object->getEnclosure())
            and $this->escape->sameValueAs($object->getEscape());
    }
}
