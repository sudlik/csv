<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidValuesException extends InvalidArgumentException
{
    public function __construct(array $values, Exception $previous = null)
    {
        parent::__construct('Invalid values "' . implode(', ', $values) . '"', null, $previous);
    }
}
