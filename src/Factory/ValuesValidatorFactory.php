<?php

namespace Csv\Factory;

use Csv\Collection\ColumnCollection;
use Csv\Validator\ValuesValidator;

class ValuesValidatorFactory
{
    public function createWithColumnCollection(ColumnCollection $columnCollection)
    {
        return new ValuesValidator($columnCollection);
    }
}
