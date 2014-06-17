<?php

namespace Csv\Collection;

use Csv\Collection;
use Csv\Row;

class RowCollection extends Collection
{
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
        return array_map(
            function (Row $cell) {
                return $cell->getValue();
            },
            $this->getArrayObject()->getArrayCopy()
        );
    }
}