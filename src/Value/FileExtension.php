<?php

namespace Csv\Value;

use Csv\Exception\InvalidFileExtensionException;
use ValueObjects\ValueObjectInterface;

final class FileExtension implements ValueObjectInterface
{
    /** @var string */
    private $value;

    public function __construct($value)
    {
        if (!preg_match('#^[^[:^print:]/.]+$#', $value)) {
            throw new InvalidFileExtensionException;
        }

        $this->value = $value;
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->getValue() === $object->getValue();
    }

    public function __toString()
    {
        return self::class . '(' . $this->getValue() . ')';
    }

    public function getValue()
    {
        return $this->value;
    }
}
