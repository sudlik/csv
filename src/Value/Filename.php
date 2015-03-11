<?php

namespace Csv\Value;

use Csv\Exception\InvalidFilenameException;
use ValueObjects\ValueObjectInterface;

final class Filename implements ValueObjectInterface
{
    /** @var string */
    private $value;

    public function __construct($value)
    {
        if (!preg_match('#^[^[:^print:]/.]+$#', $value)) {
            throw new InvalidFilenameException($value);
        }

        $this->value = $value;
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->value === $object->getValue();
    }

    public function __toString()
    {
        return self::class . '(' . $this->value . ')';
    }

    public function getValue()
    {
        return $this->value;
    }
}
