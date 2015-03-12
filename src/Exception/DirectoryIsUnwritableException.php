<?php

namespace Csv\Exception;

use Exception;
use InvalidArgumentException;

class DirectoryIsUnwritableException extends InvalidArgumentException
{
    const CODE = 2;

    public function __construct($directoryPath, Exception $exception = null)
    {
        parent::__construct($directoryPath . ' is not writable', self::CODE, $exception);
    }
}
