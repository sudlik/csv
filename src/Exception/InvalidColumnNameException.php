<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidColumnNameException extends InvalidArgumentException
{
    const CODE = 5;

    public function __construct($invalidColumnName, Exception $exception = null)
    {
        parent::__construct('Invalid column name: ' . print_r($invalidColumnName, true), self::CODE, $exception);
    }
}
