<?php

namespace Csv\Value;

use Csv\Exception\InvalidWithBomValueException;

class WithBom
{
    private $value;
    
    public function __construct($value)
    {
        if (is_bool($value)) {
            $this->value = $value;
        } else {
            throw new InvalidWithBomValueException;
        }
    }

    public function getValue()
    {
        return $this->value;
    }
}