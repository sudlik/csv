<?php

namespace Csv\Collection;

use Csv\Collection;
use Csv\Value\Position;

class RowCollection extends Collection
{
    private $freezed;

    public function add(Row $row)
    {
        $this->getArrayObject()->append($row);

        return $this;
    }

    public function set(Row $row, Position $position)
    {
        $this->getArrayObject()->offsetSet($position->getValue(), $row);

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

    public function freeze()
    {
        $this->freezed = true;

        return $this;
    }

    public function isFreezed()
    {
        return $this->freezed;
    }
}