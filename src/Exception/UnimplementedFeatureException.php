<?php

namespace Csv\Exception;

use Exception;
use RuntimeException;
use ValueObjects\ValueObjectInterface;

class UnimplementedFeatureException extends RuntimeException
{
    const CODE = 10;

    public function __construct(ValueObjectInterface $value, Exception $exception = null)
    {
        parent::__construct($value . ' is unimplemented', self::CODE, $exception);
    }
}
