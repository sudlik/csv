<?php

namespace Csv\Assertion;

class NaturalAssertion extends StringRepresentableAssertion
{
    public function assert($value)
    {
        return parent::assert($value) and ctype_digit($value);
    }
}
