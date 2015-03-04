<?php

namespace Csv\Tests\Double\Factory;

use Csv\Collection\AssertableColumnCollection;
use Csv\Factory\ValuesValidatorFromColumnsFactory;
use Csv\Tests\Double\Validator\ValidatorMock;

class ValuesValidatorFromColumnsFactoryMock implements ValuesValidatorFromColumnsFactory
{
    public function createFromColumns(AssertableColumnCollection $columnCollection)
    {
        return new ValidatorMock;
    }
}
