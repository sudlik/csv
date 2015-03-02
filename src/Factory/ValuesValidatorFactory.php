<?php

namespace Csv\Factory;

use Csv\Collection\NamedWritableColumnCollection;
use Csv\Validator\ValuesValidator;

class ValuesValidatorFactory implements ValuesValidatorFromColumnsFactory
{
    public function createFromColumns(NamedWritableColumnCollection $columnCollection)
    {
        return new ValuesValidator($columnCollection);
    }
}
