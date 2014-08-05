<?php

namespace Csv\Value;

use Csv\Exception\InvalidFilenameArgumentException;

/**
 * Class Filename
 * @package Csv
 */
final class Filename extends Value
{
    /**
     * @param $value
     */
    public function __construct($value)
    {
        if (preg_match('#^[^[:^print:]/]+$#', $value)) {
            $this->value = $value;
        } else {
            throw new InvalidFilenameArgumentException;
        }
    }
}
