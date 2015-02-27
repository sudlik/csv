<?php

namespace Csv\Assertion;

class NaturalPositiveAssertion extends NaturalAssertion
{
    public function assert($value)
    {
        return parent::assert($value) and $value > 0;
    }
}
