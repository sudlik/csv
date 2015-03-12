<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidColumnException extends InvalidArgumentException
{
    const CODE = 5;

    public function __construct($invalidColumn, Exception $exception = null)
    {
        parent::__construct('Invalid column: ' . print_r($invalidColumn, true), self::CODE, $exception);
    }
}
