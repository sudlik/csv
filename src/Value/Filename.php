<?php

namespace Csv\Value;

use Csv\Exception\InvalidFilenameArgumentException;
use Csv\Value;

class Filename extends Value
{
    public function __construct($value)
    {
        if (preg_match('#^[^[:^print:]/]+$#', $value)) {
            $this->value = $value;
        } else {
            throw new InvalidFilenameArgumentException;
        }
    }
}