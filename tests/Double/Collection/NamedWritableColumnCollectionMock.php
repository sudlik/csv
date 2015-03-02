<?php

namespace Csv\Tests\Double\Collection;

use Csv\Collection\ColumnCollection;
use Csv\Collection\NamedWritableColumnCollection;
use Csv\Column\Column;
use Traversable;

class NamedWritableColumnCollectionMock implements NamedWritableColumnCollection
{
    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
    }

    /**
     * @param ColumnCollection $columnCollection
     * @return bool
     */
    public function sameValueAs(NamedWritableColumnCollection $columnCollection)
    {
    }

    /**
     * @param string $name
     * @return Column
     */
    public function getColumn($name)
    {
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasColumn($name)
    {
    }

    /**
     * @return string[]
     */
    public function getNames()
    {
    }

    /**
     * @return bool
     */
    public function isWritable()
    {
    }

    /**
     * @return string
     */
    public function __toString()
    {
    }
}
