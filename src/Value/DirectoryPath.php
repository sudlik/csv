<?php

namespace Csv\Value;

use Csv\Exception\DirectoryDoesNotExistsException;
use ValueObjects\ValueObjectInterface;

/**
 * Class DirectoryPath
 * @package Csv
 * @method static DirectoryPath fromNative
 */
final class DirectoryPath implements ValueObjectInterface
{
    private $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        if (is_string($value) and is_dir($value)) {
            $this->value = $value;
        } else {
            throw new DirectoryDoesNotExistsException;
        }
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->value === $object->getValue();
    }

    public function __toString()
    {
        return 'DirectoryPath(' . $this->value . ')';
    }

    public function getValue()
    {
        return $this->value;
    }
}
