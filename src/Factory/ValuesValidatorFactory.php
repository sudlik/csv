<?php

namespace Csv\Factory;

use Csv\Collection\NamedWritableColumnCollection;
use Csv\Validator\ValuesValidator;

class ValuesValidatorFactory
{
    public function createWithColumnCollection(NamedWritableColumnCollection $columnCollection)
    {
        return new ValuesValidator($columnCollection);
    }
}
