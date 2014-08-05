<?php

namespace Csv\Collection;

use Csv\Exception\CollectionIsFrozenException;
use Csv\Value\Position;

/**
 * Class RowCollection
 * @package Csv
 */
class RowCollection extends Collection
{
    /**
     * @param Row $row
     * @return $this
     * @throws CollectionIsFrozenException
     */
    public function add(Row $row)
    {
        if ($this->isFrozen()) {
            throw new CollectionIsFrozenException;
        } else {
            $this->getArrayObject()->append($row);
        }

        return $this;
    }

    /**
     * @param Row $row
     * @param Position $position
     * @return $this
     * @throws CollectionIsFrozenException
     */
    public function set(Row $row, Position $position)
    {
        if ($this->isFrozen()) {
            throw new CollectionIsFrozenException;
        } else {
            $this->getArrayObject()->offsetSet($position->getValue(), $row);
        }

        return $this;
    }

    /**
     * @param Row $row
     * @return bool
     */
    public function has(Row $row)
    {
        return (bool)in_array($row, $this->getArrayObject()->getArrayCopy());
    }

    /**
     * @return array
     */
    public function asArray()
    {
        $array = array_map(
            function (Row $row) {
                return $row->asArray();
            },
            $this->getArrayObject()->getArrayCopy()
        );

        ksort($array);

        return $array;
    }

    /**
     * @return $this
     */
    public function freeze()
    {
        foreach ($this->getArrayObject() as $row) {
            $row->freeze();
        }

        return parent::freeze();
    }
}
