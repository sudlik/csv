<?php

namespace Csv\Value;

use Csv\Exception\InvalidCellValueException;

/**
 * Class Cell
 * @package Csv
 */
final class Cell extends Value
{
    /**
     * @param null $value
     */
    public function __construct($value = null)
    {
        if (is_scalar($value) or is_null($value)) {
            $this->value = $value;
        } else {
            throw new InvalidCellValueException;
        }
    }
}
