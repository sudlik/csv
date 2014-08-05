<?php

namespace Csv\Value;

use Csv\Exception\DirectoryDoesNotExistsException;

/**
 * Class DirectoryPath
 * @package Csv
 */
final class DirectoryPath extends Value
{
    /**
     * @param $value
     */
    public function __construct($value)
    {
        if (is_string($value) and is_dir($value)) {
            $this->value = $value;
        } else {
            throw new DirectoryDoesNotExistsException;
        }
    }
}
