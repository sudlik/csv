<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidAsciiCharacterException extends InvalidArgumentException
{
    const CODE = 3;

    public function __construct($invalidAsciiChar, Exception $exception = null)
    {
        parent::__construct('Invalid ASCII character: ' . print_r($invalidAsciiChar, true), self::CODE, $exception);
    }
}
