<?php

namespace Csv;

use ArrayObject;
use Csv\Value\Position;

class Collection
{
    private $arrayObject;

    public function __construct()
    {
        $this->arrayObject = new ArrayObject;
    }

    protected function getArrayObject()
    {
        return $this->arrayObject;
    }

    public function first()
    {
        return $this->get(0);
    }

    public function all()
    {
        return $this->getArrayObject()->getArrayCopy();
    }

    public function count()
    {
        return $this->getArrayObject()->count();
    }

    public function get($index)
    {
        return $this->getArrayObject()->offsetExists($index) ? $this->getArrayObject()->offsetGet($index) : null;
    }

    public function exists(Position $position)
    {
        return $this->getArrayObject()->offsetExists($position->getValue());
    }

    public function size()
    {
        if ($this->count()) {
            $array = $this->getArrayObject();

            end($array);

            return key($array) + 1;
        } else {
            return 0;
        }
    }
}