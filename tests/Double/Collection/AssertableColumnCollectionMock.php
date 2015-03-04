<?php

namespace Csv\Tests\Double\Collection;

use ArrayIterator;
use Csv\Collection\AssertableColumnCollection;
use Csv\Collection\NamedWritableColumnCollection;
use Csv\Column\AssertableColumn;
use Csv\Exception\ColumnDoesNotExistsException;

class AssertableColumnCollectionMock extends AssertableColumnCollection
{
    /** @var array */
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }

    public function sameValueAs(NamedWritableColumnCollection $columns)
    {
        return false;
    }

    /**
     * @param string $name
     * @return AssertableColumn
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
