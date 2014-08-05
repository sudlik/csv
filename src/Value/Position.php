<?php

namespace Csv\Value;

use Csv\Exception\InvalidPositionValueException;

/**
 * Class Position
 * @package Csv
 */
final class Position extends Value
{
    /**
     * @param $value
     */
    public function __construct($value)
    {
        if (is_int($value)) {
            $this->value = $value;
        } else {
            throw new InvalidPositionValueException;
        }
    }
}
