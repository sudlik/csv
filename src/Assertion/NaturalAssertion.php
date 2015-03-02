<?php

namespace Csv\Assertion;

class NaturalAssertion extends StringRepresentableAssertion
{
    public function assert($value)
    {
        $value = (string)$value;
        if (strlen($value) > 1) {
            $value = ltrim($value, '-');
        }

        return parent::assert($value) and ctype_digit($value);
    }
}
