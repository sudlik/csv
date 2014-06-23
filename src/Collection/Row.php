<?php

namespace Csv\Collection;

use Csv\Cell;
use Csv\Collection;
use Csv\Value\Position;

/** Row
 * Cell collection
 * @package Csv
 */
class Row extends Collection
{
    public function add(Cell $cell)
    {
        $this->getArrayObject()->append($cell);

        return $this;
    }

    public function set(Cell $cell, Position $position)
    {
        $this->getArrayObject()->offsetSet($position->getValue(), $cell);

        return $this;
    }

    public function has(Cell $cell)
    {
        return (bool)in_array($cell, $this->getArrayObject()->getArrayCopy());
    }

    public function asArray()
    {
        $array = array_map(
            function (Cell $cell) {
                return $cell->getValue();
            },
            $this->getArrayObject()->getArrayCopy()
        );

        ksort($array);

        return $array;
    }
}