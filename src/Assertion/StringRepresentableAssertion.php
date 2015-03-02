<?php

namespace Csv\Assertion;

use Csv\Value\NaturalRange;
use ValueObjects\Number\Natural;

class StringRepresentableAssertion
{
    private $range;

    public function __construct(NaturalRange $range)
    {
        $this->range = $range;
    }

    public function assert($value)
    {
        if (is_scalar($value) or is_null($value)) {
            return $this->inRange(strlen($value));
        } elseif (is_object($value) and method_exists($value, '__toString')) {
            return $this->inRange(strlen((string)$value));
        } else {
            return false;
        }
    }

    public function __toString()
    {
        return (string)self::class;
    }

    private function inRange($length)
    {
        return $this->range->isInRange(new Natural($length));
    }
}
