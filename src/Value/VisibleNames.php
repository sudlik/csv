<?php

namespace Csv\Value;

use Csv\Exception\InvalidVisibleNamesValueException;

/**
 * Class VisibleNames
 * @package Csv
 */
final class VisibleNames extends Value
{
    /**
     * @param $value
     */
    public function __construct($value)
    {
        if (is_bool($value)) {
            $this->value = $value;
        } else {
            throw new InvalidVisibleNamesValueException;
        }
    }
}
