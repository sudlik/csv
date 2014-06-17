<?php

namespace Csv\ValueObject;

use Csv\Exception\InvalidFilenameArgumentException;
use Csv\ValueObject;

class FilenameValueObject implements ValueObject
{
    private $value;
    
    public function __construct($filename)
    {
        if (preg_match('#^[^[:^print:]/]+$#', $filename)) {
            $this->value = $filename;
        } else {
            throw new InvalidFilenameArgumentException;
        }
    }

    public function getValue()
    {
        return $value;
    }
}