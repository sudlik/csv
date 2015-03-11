<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidWritableException extends InvalidArgumentException
{
    const CODE = 9;

    public function __construct($invalidWritable, Exception $exception = null)
    {
        parent::__construct('Invalid writable: ' . print_r($invalidWritable, true), self::CODE, $exception);
    }
}
