<?php

namespace Csv\Value;

use Csv\Exception\InvalidVisibleNamesValueException;
use ValueObjects\ValueObjectInterface;

final class CsvConfig implements ValueObjectInterface
{
    /** @var Delimiter */
    private $delimiter;

    /** @var Enclosure */
    private $enclosure;

    private $visibleNames;

    public function __construct(Delimiter $delimiter, Enclosure $enclosure, $visibleNames)
    {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;

        if (is_bool($visibleNames)) {
            $this->visibleNames = $visibleNames;
        } else {
            throw new InvalidVisibleNamesValueException;
        }
    }

    public static function fromNative()
    {
        return new self(
            Delimiter::fromNative(func_get_arg(0)),
            Enclosure::fromNative(func_get_arg(1)),
            func_get_arg(2)
        );
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $object instanceof self
            and $this->delimiter->is($object->getDelimiter())
            and $this->enclosure->is($object->getEnclosure())
            and $this->visibleNames === $object->getVisibleNames();
    }

    public function getDelimiter()
    {
        return $this->delimiter;
    }

    public function getEnclosure()
    {
        return $this->enclosure;
    }

    public function getVisibleNames()
    {
        return $this->visibleNames;
    }

    public function __toString()
    {
        return 'CsvConfig('
        . $this->delimiter . ', '
        . $this->enclosure . ', '
        . ($this->visibleNames ? 'true' : 'false')
        . ')';
    }
}
