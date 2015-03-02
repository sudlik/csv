<?php

namespace Csv\Tests\Double\Validator;

use Csv\Validator\Validator;

class ValidatorMock implements Validator
{
    /**
     * @param array $values
     * @return bool
     */
    public function validate(array $values)
    {
        return true;
    }
}
