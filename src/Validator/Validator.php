<?php
namespace Csv\Validator;

interface Validator
{
    /**
     * @param array $values
     * @return bool
     */
    public function validate(array $values);
}
