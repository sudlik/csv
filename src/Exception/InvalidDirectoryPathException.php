<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidDirectoryPathException extends InvalidArgumentException
{
    const CODE = 7;

    public function __construct($invalidDirPath, Exception $exception = null)
    {
        parent::__construct('Invalid directory path: ' . print_r($invalidDirPath, true), self::CODE, $exception);
    }
}
