<?php

namespace Csv\Value;

use Csv\Exception\InvalidWithBomValueException;
use Csv\Value;

class WithBom extends Value
{
    public function __construct($value)
    {
        if (is_bool($value)) {
            $this->value = $value;
        } else {
            throw new InvalidWithBomValueException;
        }
    }
}