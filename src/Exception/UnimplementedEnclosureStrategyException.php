<?php

namespace Csv\Exception;

use Csv\Value\EnclosureStrategy;
use DomainException;
use Exception;

class UnimplementedEnclosureStrategyException extends DomainException
{
    const CODE = 11;

    public function __construct(EnclosureStrategy $enclosureStrategy, Exception $exception = null)
    {
        parent::__construct($enclosureStrategy . ' is unimplemented', self::CODE, $exception);
    }
}
