<?php

namespace Csv\Value;

use ValueObjects\ValueObjectInterface;

/**
 * Class Value
 * @package Csv
 */
abstract class Value implements ValueObjectInterface
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return string
     */
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
        return new static(func_get_arg(0));
    }

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  self $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object)
    {
        return $this->value === $object->getValue();
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
