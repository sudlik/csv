<?php

namespace Csv\Value;

use ValueObjects\Number\Natural;
use ValueObjects\Number\NumberRange;

/**
 * @method Natural getBegin
 * @method Natural getEnd
 */
final class NaturalRange extends NumberRange
{
    public function __construct(Natural $begin, Natural $end)
    {
        parent::__construct($begin, $end);
    }

    public function __toString()
    {
        return self::class . '(' . $this->getBegin() . ', ' . $this->getEnd() . ')';
    }

    public static function fromNative()
    {
        return new self(new Natural(func_get_arg(0)), new Natural(func_get_arg(1)));
    }
}
