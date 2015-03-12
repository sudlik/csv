<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidFilenameException extends InvalidArgumentException
{
    const CODE = 9;

    public function __construct($invalidFilename, Exception $exception = null)
    {
        parent::__construct('Invalid filename: ' . print_r($invalidFilename, true), self::CODE, $exception);
    }
}
