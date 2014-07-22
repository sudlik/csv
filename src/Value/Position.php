<?php

namespace Csv\Value;

use Csv\Exception\InvalidPositionValueException;

final class Position extends Value
{
    public function __construct($value)
    {
        if (is_int($value)) {
            $this->value = $value;
        } else {
            throw new InvalidPositionValueException;
        }
    }
}
