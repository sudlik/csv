<?php

namespace Csv;

use Csv\Value;

class Cell
{
    private $value;

    public function __construct(Value $value = null)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}