<?php

namespace Csv;

use Csv\Exception\InvalidCellValueException;

class Cell
{
    private $value;
    
    public function __construct($value = null)
    {
        if ($this->isValid($value)) {
            $this->value = $value;
        } else {
            throw new InvalidCellValueException;
        }
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string)$this->value;
    }

    private function isValid($value)
    {
        return is_scalar($value) or is_null($value);
    }
}