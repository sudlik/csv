<?php

namespace Csv;

use Exception;

class Position
{
    private $value;
    
    public function __construct($value)
    {
        if (is_scalar($value)) {
            $this->value = $value;
        } else {
            throw new Exception;
        }
    }

    public function getValue()
    {
        return $this->value;
    }
}