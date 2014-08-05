<?php

namespace Csv\Factory;

use Csv\Value\VisibleNames;

/**
 * Class VisibleNamesFactory
 * @package Csv
 */
class VisibleNamesFactory
{
    /**
     * @param bool $value
     * @return VisibleNames
     */
    public function create($value = true)
    {
        return new VisibleNames($value);
    }
}
