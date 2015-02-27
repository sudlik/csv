<?php

namespace Csv\Assertion;

class NotANaturalAssertion extends NaturalAssertion
{
    public function assert($value)
    {
        return !parent::assert($value);
    }
}
