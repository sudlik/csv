<?php
namespace Csv\Factory;

use Csv\Collection\NamedWritableColumnCollection;

interface ValuesValidatorFromColumnsFactory
{
    public function createFromColumns(NamedWritableColumnCollection $columnCollection);
}
