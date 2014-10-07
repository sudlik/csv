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
    /**
     * @param Cell $cell
     * @return $this
     * @throws CollectionIsFrozenException
     */
    public function add(Cell $cell)
    {
        if ($this->frozen) {
            throw new CollectionIsFrozenException;
        } else {
            $this->arrayObject->append($cell);
        }

        return $this;
    }

    /**
     * @param Cell $cell
     * @param Position $position
     * @return $this
     * @throws CollectionIsFrozenException
     */
    public function set(Cell $cell, Position $position)
    {
        if ($this->frozen) {
            throw new CollectionIsFrozenException;
        } else {
            $this->arrayObject->offsetSet($position->getValue(), $cell);
        }

        return $this;
    }

    /**
     * @param Cell $cell
     * @return bool
     */
    public function has(Cell $cell)
    {
        return (bool)in_array($cell, $this->arrayObject->getArrayCopy());
    }

    /**
     * @return array
     */
    public function asArray()
    {
        $array = array_map(
            function (Cell $cell) {
                return $cell->getValue();
            },
            $this->arrayObject->getArrayCopy()
        );

        ksort($array);

        return $array;
    }
}
