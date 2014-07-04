<?php

namespace Csv\Factory;

use Csv\Value\WithBom;

class WithBomFactory
{
    public function create($value = true)
    {
        return new WithBom($value);
    }
}
