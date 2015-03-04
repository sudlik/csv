<?php

namespace Csv\Validator;

use Csv\Assertion\StringRepresentableAssertion;
use Csv\Collection\AssertableColumnCollection;
use Csv\Column\AssertableColumn;

class ValuesValidator implements Validator
{
    /** @var StringRepresentableAssertion[] */
    private $assertions = [];

    private $names;

    public function __construct(AssertableColumnCollection $columnCollection)
    {
        $this->names = $columnCollection->getNames();

        /** @var AssertableColumn $column */
        foreach ($columnCollection as $column) {
            $this->assertions[$column->getName()] = $column->getAssertion();
        }
    }

    public function validate(array $values)
    {
        if ($this->names === array_keys($values)) {
            foreach ($values as $name => $value) {
                if (!$this->assertions[$name]->assert($value)) {
                    return false;
                }
            }

            return true;
        } else {
            return false;
        }
    }
}
