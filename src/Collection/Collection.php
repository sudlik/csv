<?php

namespace Csv\Collection;

use ArrayObject;
use Csv\Value\Position;

/**
 * Class Collection
 * @package Csv
 */
abstract class Collection
{
    /**
     * @var ArrayObject
     */
    private $arrayObject;

    /**
     * @var bool
     */
    private $frozen = false;

    public function __construct()
    {
        $this->arrayObject = new ArrayObject;
    }

    public function __clone()
    {
        $this->frozen = false;
    }

    /**
     * @return ArrayObject
     */
    protected function getArrayObject()
    {
        return $this->arrayObject;
    }

    /**
     * @return mixed|null
     */
    public function first()
    {
        return $this->get(0);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->getArrayObject()->getArrayCopy();
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->getArrayObject()->count();
    }

    /**
     * @param $index
     * @return mixed|null
     */
    public function get($index)
    {
        if ($this->getArrayObject()->offsetExists($index)) {
            return $this->getArrayObject()->offsetGet($index);
        } else {
            return null;
        }
    }

    /**
     * @param Position $position
     * @return bool
     */
    public function exists(Position $position)
    {
        return $this->getArrayObject()->offsetExists($position->getValue());
    }

    /**
     * @return int|mixed
     */
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

    /**
     * @return $this
     */
    public function freeze()
    {
        $this->frozen = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFrozen()
    {
        return $this->frozen;
    }
}
