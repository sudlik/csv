<?php

namespace Csv;

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
        return array_map(
            function (Cell $cell) {
                return $cell->getContent()->getValue();
            },
            $this->getArrayObject()->getArrayCopy()
        );
    }
}