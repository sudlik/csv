<?php

namespace Csv;

use ValueObjects\ValueObjectInterface;

class Value implements ValueObjectInterface
{
    protected $value;

    public function __toString()
    {
        return (string)$this->value;
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
        return $this->value === $object->getValue();
    }

    public function toNative()
    {
        return (string)$this->value;
    }
}