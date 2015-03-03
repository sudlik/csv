<?php

namespace Csv\Tests\Double\Assertion;

use Csv\Assertion\StringRepresentableAssertion;

class StringRepresentableAssertionMock extends StringRepresentableAssertion
{
    public function __construct()
    {
    }

    public function assert($value)
    {
        return true;
    }
}
