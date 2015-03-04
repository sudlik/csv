<?php
namespace Csv\Factory;

use Csv\Collection\AssertableColumnCollection;

interface ValuesValidatorFromColumnsFactory
{
    public function createFromColumns(AssertableColumnCollection $columnCollection);
}
