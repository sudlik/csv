<?php

namespace Csv;

use Exception;

class Content
{
    private $value;
    
    public function __construct($value = null)
    {
        if ($this->isValid($value)) {
            $this->value = $value;
        } else {
            throw new Exception;
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
            throw new Exception;
        }

        return $this;
    }

    private function isValid($value)
    {
        return is_scalar($value) || is_null($value);
    }
}