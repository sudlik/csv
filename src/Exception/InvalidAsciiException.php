<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidAsciiException extends InvalidArgumentException
{
    const CODE = 3;

    public function __construct($invalidAscii, Exception $exception = null)
    {
        parent::__construct('Invalid ASCII: ' . print_r($invalidAscii, true), self::CODE, $exception);
    }
}
