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

    public function getArrayObject()
    {
        return $this->arrayObject;
    }

    public function first()
    {
        return $this->getArrayObject()->offsetGet(0);
    }

    public function last()
    {
        return $this->getArrayObject()->offsetGet($this->getArrayObject()->count());
    }
}