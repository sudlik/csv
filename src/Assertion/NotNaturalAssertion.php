<?php

namespace Csv\Assertion;

class NotNaturalAssertion extends NaturalAssertion
{
    public function assert($value)
    {
        return !parent::assert($value);
    }
}
