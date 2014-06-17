<?php

namespace Csv\Value;

use Csv\Exception\InvalidFilenameArgumentException;
use ValueObjects\ValueObjectInterface;

class Filename implements ValueObjectInterface
{
    private $value;
    
    public function __construct($filename)
    {
        if (preg_match('#^[^[:^print:]/]+$#', $filename)) {
            $this->filename = $filename;
        } else {
            throw new InvalidFilenameArgumentException;
        }
    }

    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @return ValueObjectInterface
     */
    public static function fromNative()
    {
        return new self(func_get_arg(0));
    }

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object)
    {
        return $this->toNative() === $object->toNative();
    }

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toNative();
    }

    public function toNative()
    {
        return $this->filename;
    }
}