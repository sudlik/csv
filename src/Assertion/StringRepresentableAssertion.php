<?php

namespace Csv\Assertion;

use Csv\Value\NaturalRange;

class StringRepresentableAssertion
{
    private $begin;
    private $end;
    private $range;

    public function __construct(NaturalRange $range)
    {
        $this->range = $range;
        $this->begin = $range->getBegin()->toNative();
        $this->end = $range->getEnd()->toNative();
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
        return self::class . '(' . $this->range . ')';
    }

    private function inRange($length)
    {
        return $this->begin <= $length and $this->end >= $length;
    }
}
