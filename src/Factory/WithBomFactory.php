<?php

namespace Csv\Factory;

use Csv\Value\WithBom;

/**
 * Class WithBomFactory
 * @package Csv
 */
class WithBomFactory
{
    /**
     * @param bool $value
     * @return WithBom
     */
    public function create($value = true)
    {
        return new WithBom($value);
    }
}
