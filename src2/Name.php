<?php

namespace Csv;

use ArrayObject;

class Row extends Collection
{
    private $index;
    
    public function __construct($index)
    {
        if (is_int($index)) {
            $this->index = $index;
        } else {
            throw new InvalidIndexArgumentException('Integer expected');
        }
    }

    public function asArray()
    {
        return array_map(
            function (Cell $cell) {
                return $cell->getValue();
            },
            $this->getArrayObject()
        );
    }

    public function add(Cell $cell)
    {
        $this->getArrayObject()[] = $cell;
    }

    public function index()
    {
        return $this->index;
    }
}