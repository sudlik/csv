<?php

namespace Csv\Factory;

use Csv\Collection\AssertableColumnCollection;
use Csv\Validator\ValuesValidator;

class ValuesValidatorFactory implements ValuesValidatorFromColumnsFactory
{
    public function createFromColumns(AssertableColumnCollection $columnCollection)
    {
        return new ValuesValidator($columnCollection);
    }
}
