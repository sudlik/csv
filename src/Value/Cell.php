<?php

namespace Csv\Value;

use Csv\Exception\InvalidCellValueException;

final class Cell extends Value
{
    public function __construct($value = null)
    {
        if (is_scalar($value) or is_null($value)) {
            $this->value = $value;
        } else {
            throw new InvalidCellValueException;
        }
    }
}
