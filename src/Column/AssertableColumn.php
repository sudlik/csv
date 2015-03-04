<?php

namespace Csv\Column;

use Csv\Assertion\StringRepresentableAssertion;
use Csv\Value\Column;
use ValueObjects\ValueObjectInterface;

class AssertableColumn extends Column
{
    private $assertion;

    public function __construct($name, StringRepresentableAssertion $assertion)
    {
        parent::__construct($name);

        $this->assertion = $assertion;
    }

    final public function getAssertion()
    {
        return $this->assertion;
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            parent::sameValueAs($object)
            and $object instanceof self
            and is_a($object->getAssertion(), get_class($this->assertion));
    }

    public function __toString()
    {
        return self::class . '(' . $this->getName() . ', ' . $this->assertion . ')';
    }
}
