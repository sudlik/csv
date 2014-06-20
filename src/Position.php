<?php

namespace Csv;

use Csv\Exception\InvalidPositionValueException;

class Position
{
    private $value;
    
    public function __construct($value)
    {
        if (is_scalar($value)) {
            $this->value = $value;
        } else {
            throw new InvalidPositionValueException;
        }
    }

    public function getValue()
    {
        return $this->value;
    }
}