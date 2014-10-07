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
    protected $arrayObject;

    /**
     * @var bool
     */
    protected $frozen = false;

    public function __construct()
    {
        $this->arrayObject = new ArrayObject;
    }

    public function __clone()
    {
        $this->frozen = false;
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
        return $this->arrayObject->getArrayCopy();
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->arrayObject->count();
    }

    /**
     * @param $index
     * @return mixed|null
     */
    public function get($index)
    {
        if ($this->arrayObject->offsetExists($index)) {
            return $this->arrayObject->offsetGet($index);
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
        return $this->arrayObject->offsetExists($position->getValue());
    }

    /**
     * @return int|mixed
     */
    public function size()
    {
        if ($this->count()) {
            $array = $this->arrayObject;

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
