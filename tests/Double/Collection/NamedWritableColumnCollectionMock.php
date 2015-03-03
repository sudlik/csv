<?php

namespace Csv\Tests\Double\Collection;

use ArrayIterator;
use Csv\Collection\ColumnCollection;
use Csv\Collection\NamedWritableColumnCollection;
use Csv\Column\Column;
use Csv\Exception\ColumnDoesNotExistsException;
use Traversable;

class NamedWritableColumnCollectionMock implements NamedWritableColumnCollection
{
    /** @var array */
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return new ArrayIterator([]);
    }

    /**
     * @param ColumnCollection $columnCollection
     * @return bool
     */
    public function sameValueAs(NamedWritableColumnCollection $columnCollection)
    {
        return false;
    }

    /**
     * @param string $name
     * @return Column
     * @throws ColumnDoesNotExistsException
     */
    public function getColumn($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            throw new ColumnDoesNotExistsException;
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasColumn($name)
    {
        return false;
    }

    /**
     * @return string[]
     */
    public function getNames()
    {
        return array_keys($this->data);
    }

    /**
     * @return bool
     */
    public function isWritable()
    {
        return false;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return '';
    }
}
