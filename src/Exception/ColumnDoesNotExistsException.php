<?php

namespace Csv\Exception;

use Csv\Collection\ColumnCollection;
use Exception;
use OutOfRangeException;

class ColumnDoesNotExistsException extends OutOfRangeException
{
    const CODE = 1;

    public function __construct($columnName, ColumnCollection $columnCollection, Exception $exception = null)
    {
        parent::__construct($columnName . ' does not exists in: ' . $columnCollection, self::CODE, $exception);
    }
}
