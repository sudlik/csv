<?php

namespace Csv\Value;

use Csv\Exception\InvalidWithBomValueException;

/**
 * Class WithBom
 * @package Csv
 */
final class WithBom extends Value
{
    /**
     * @param $value
     */
    public function __construct($value)
    {
        if (is_bool($value)) {
            $this->value = $value;
        } else {
            throw new InvalidWithBomValueException;
        }
    }
}
