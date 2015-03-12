<?php
namespace Csv\Value;

use Csv\Exception\InvalidColumnNameException;
use ValueObjects\ValueObjectInterface;

final class Column implements ValueObjectInterface
{
    /** @var string */
    private $name;

    public function __construct($name)
    {
        if (preg_match('#^([^[:print:]]|\s)$#', $name)) {
            throw new InvalidColumnNameException($name);
        }

        $this->name = $name;
    }

    public function getName()
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
