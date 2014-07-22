<?php

namespace Csv\Value;

use Csv\Exception\DirectoryDoesNotExistsException;

final class DirectoryPath extends Value
{
    public function __construct($value)
    {
        if (is_string($value) and is_dir($value)) {
            $this->value = $value;
        } else {
            throw new DirectoryDoesNotExistsException;
        }
    }
}
