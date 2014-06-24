<?php

namespace Csv\Collection;

use Csv\Collection;
use Csv\Exception\CollectionIsFrozenException;
use Csv\Value\Position;

class RowCollection extends Collection
{
    public function add(Row $row)
    {
        if ($this->isFrozen()) {
            throw new CollectionIsFrozenException;
        } else {
            $this->getArrayObject()->append($row);
        }

        return $this;
    }

    public function set(Row $row, Position $position)
    {
        if ($this->isFrozen()) {
            throw new CollectionIsFrozenException;
        } else {
            $this->getArrayObject()->offsetSet($position->toNative(), $row);
        }

        return $this;
    }

    public function has(Row $row)
    {
        return (bool)in_array($row, $this->getArrayObject()->getArrayCopy());
    }
    
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
}