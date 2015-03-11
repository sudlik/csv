<?php

namespace Csv\Exception;

use Csv\Collection\ColumnCollection;
use Csv\Value\Column;
use Exception;
use OutOfBoundsException;

class ColumnAlreadyExistsException extends OutOfBoundsException
{
    const CODE = 0;

    public function __construct(Column $column, ColumnCollection $columnCollection, Exception $exception = null)
    {
        parent::__construct($column . ' already exists in: ' . $columnCollection, self::CODE, $exception);
    }
}
