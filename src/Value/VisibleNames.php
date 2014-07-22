<?php

namespace Csv\Value;

use Csv\Exception\InvalidVisibleNamesValueException;

final class VisibleNames extends Value
{
    public function __construct($value)
    {
        if (is_bool($value)) {
            $this->value = $value;
        } else {
            throw new InvalidVisibleNamesValueException;
        }
    }
}
