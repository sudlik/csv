<?php

namespace Csv\Value;

use Csv\Exception\DirectoryDoesNotExistsException;
use ValueObjects\ValueObjectInterface;

class DirectoryPath implements ValueObjectInterface
{
    private $directoryPath;
    
    public function __construct($directoryPath)
    {
        if (is_string($directoryPath) and is_dir($directoryPath)) {
            $this->directoryPath = $directoryPath;
        } else {
            throw new DirectoryDoesNotExistsException;
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
        return $this->directoryPath;
    }
}