<?php

namespace Csv\Collection;

use Csv\Exception\CollectionIsFrozenException;
use Csv\Value\Cell;
use Csv\Value\Position;

/** Row
 * Cell collection
 * @package Csv
 */
class Row extends Collection
{
    public function add(Cell $cell)
    {
        if ($this->isFrozen()) {
            throw new CollectionIsFrozenException;
        } else {
            $this->getArrayObject()->append($cell);
        }

        return $this;
    }

    public function set(Cell $cell, Position $position)
    {
        if ($this->isFrozen()) {
            throw new CollectionIsFrozenException;
        } else {
            $this->getArrayObject()->offsetSet($position->getValue(), $cell);
        }

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
