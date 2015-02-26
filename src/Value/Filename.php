<?php

namespace Csv\Value;

use Csv\Exception\InvalidFilenameArgumentException;
use ValueObjects\ValueObjectInterface;

/**
 * Class Filename
 * @package Csv
 * @method static Filename fromNative
 */
final class Filename implements ValueObjectInterface
{
    private $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        if (preg_match('#^[^[:^print:]/]+$#', $value)) {
            $this->value = $value;
        } else {
            throw new InvalidFilenameArgumentException;
        }
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->value === $object->getValue();
    }

    public function __toString()
    {
        return 'Filename(' . $this->value . ')';
    }

    public function getValue()
    {
        return $this->value;
    }
}
