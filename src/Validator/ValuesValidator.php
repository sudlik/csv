<?php

namespace Csv\Validator;

use Csv\Collection\NamedWritableColumnCollection;

class ValuesValidator implements Validator
{
    /** @var NamedWritableColumnCollection */
    private $columnCollection;

    public function __construct(NamedWritableColumnCollection $columnCollection)
    {
        $this->columnCollection = $columnCollection;
    }

    public function validate(array $values)
    {
        if ($this->columnCollection->getNames() === array_keys($values)) {
            foreach ($values as $name => $value) {
                if (!$this->columnCollection->getColumn($name)->getAssertion()->assert($value)) {
                    return false;
                }
            }

            return true;
        } else {
            return false;
        }
    }
}
