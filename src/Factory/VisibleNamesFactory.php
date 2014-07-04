<?php

namespace Csv\Factory;

use Csv\Value\VisibleNames;

class VisibleNamesFactory
{
    public function create($value = true)
    {
        return new VisibleNames($value);
    }
}
