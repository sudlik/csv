<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidAsciiIntegerException extends InvalidArgumentException
{
    const CODE = 4;

    public function __construct($invalidAsciiInteger, Exception $exception = null)
    {
        parent::__construct('Invalid ASCII integer: ' . print_r($invalidAsciiInteger, true), self::CODE, $exception);
    }
}
