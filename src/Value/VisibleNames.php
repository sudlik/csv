<?php

namespace Csv\Value;

use Csv\Exception\InvalidVisibleNamesValueException;

class VisibleNames
{
    private $value;
    
    public function __construct($value)
    {
        if (is_bool($value)) {
            $this->value = $value;
        } else {
            throw new InvalidVisibleNamesValueException;
        }
    }

    public function getValue()
    {
        return $this->value;
    }
}