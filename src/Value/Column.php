<?php
namespace Csv\Value;

use Csv\Exception\InvalidColumnNameException;
use ValueObjects\ValueObjectInterface;

class Column implements ValueObjectInterface
{
    private $name;

    public function __construct($name)
    {
        if (is_string($name)) {
            $this->name = $name;
        } else {
            throw new InvalidColumnNameException($name);
        }
    }

    final public function getName()
    {
        return $this->name;
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->name === $object->getName();
    }

    public function __toString()
    {
        return self::class . '(' . $this->name . ')';
    }
}
