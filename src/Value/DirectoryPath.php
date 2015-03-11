<?php

namespace Csv\Value;

use Csv\Exception\DirectoryIsNotWritableException;
use Csv\Exception\InvalidDirectoryPathException;
use ValueObjects\ValueObjectInterface;

final class DirectoryPath implements ValueObjectInterface
{
    private $value;

    public function __construct($value)
    {
        if (!is_dir($value)) {
            throw new InvalidDirectoryPathException($value);
        }

        if (!is_writable($value)) {
            throw new DirectoryIsNotWritableException($value);
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
