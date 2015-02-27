<?php

namespace Csv;

use Csv\Assertion\StringRepresentableAssertion;
use Csv\Exception\InvalidColumnNameException;

class Column
{
    private $name;
    private $assertion;

    public function __construct($name, StringRepresentableAssertion $assertion)
    {
        $this->assertion = $assertion;

        if (is_string($name)) {
            $this->name = $name;
        } else {
            throw new InvalidColumnNameException;
        }
    }

    public function sameValueAs(Column $object)
    {
        return
            $object instanceof self
            and $this->name === $object->getName()
            and is_a($object->getAssertion(), get_class($this->assertion));
    }

    public function __toString()
    {
        return self::class . '(' . $this->name . ', ' . $this->assertion . ')';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAssertion()
    {
        return $this->assertion;
    }
}
