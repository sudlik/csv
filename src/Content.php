<?php

namespace Csv;

use Csv\Exception\InvalidContentValueException;

class Content
{
    private $value;
    
    public function __construct($value = null)
    {
        if ($this->isValid($value)) {
            $this->value = $value;
        } else {
            throw new InvalidContentValueException;
        }
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        if ($this->isValid($value)) {
            $this->value = $value;
        } else {
            throw new InvalidContentValueException;
        }

        return $this;
    }

    private function isValid($value)
    {
        return is_scalar($value) or is_null($value);
    }
}