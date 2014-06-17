<?php

namespace Csv;

use ArrayObject;

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
}