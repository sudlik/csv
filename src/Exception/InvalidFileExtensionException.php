<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class InvalidFileExtensionException extends InvalidArgumentException
{
    const CODE = 7;

    public function __construct($invalidFileExt, Exception $exception = null)
    {
        parent::__construct('Invalid file extension: ' . print_r($invalidFileExt, true), self::CODE, $exception);
    }
}
