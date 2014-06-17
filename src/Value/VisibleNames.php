<?php

namespace Csv\Value;

use Exception;

class VisibleNames
{
    private $value;
    
    public function __construct($value)
    {
        if (is_bool($value)) {
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