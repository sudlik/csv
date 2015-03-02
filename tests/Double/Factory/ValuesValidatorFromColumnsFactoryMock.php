<?php

namespace Csv\Tests\Double\Factory;

use Csv\Collection\NamedWritableColumnCollection;
use Csv\Factory\ValuesValidatorFromColumnsFactory;
use Csv\Tests\Double\Validator\ValidatorMock;

class ValuesValidatorFromColumnsFactoryMock implements ValuesValidatorFromColumnsFactory
{
    public function createFromColumns(NamedWritableColumnCollection $columnCollection)
    {
        return new ValidatorMock;
    }
}
