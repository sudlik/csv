<?php

namespace Csv\Collection;

use ArrayIterator;
use Csv\Exception\ColumnAlreadyExistsException;
use Csv\Exception\ColumnDoesNotExistsException;
use Csv\Exception\InvalidColumnException;
use Csv\Exception\InvalidWritableException;
use Csv\Value\Column;

class ColumnCollection implements NamedWritableColumnCollection
{
    private $nameIndexedColumns = [];

    protected $iterator;
    protected $writable;

    public function __construct(array $columns, $writable)
    {
        $this->writable = $writable;
        $this->iterator = new ArrayIterator($columns);

        if (!is_bool(filter_var($writable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE))) {
            throw new InvalidWritableException($writable);
        }

        foreach ($columns as $column) {
            if (!($column instanceof Column)) {
                throw new InvalidColumnException($column);
            } elseif ($this->hasColumn($column->getName())) {
                throw new ColumnAlreadyExistsException($column, $this);
            } else {
                $this->nameIndexedColumns[$column->getName()] = $column;
            }
        }
    }

    public function sameValueAs(NamedWritableColumnCollection $columns)
    {
        return $this->getNames() === $columns->getNames() and $this->writable === $columns->isWritable();
    }

    public function __toString()
    {
        return self::class . '('
        . implode(', ', $this->nameIndexedColumns) . ', '
        . ($this->writable ? 'true' : 'false') . ')';
    }

    /**
     * @param string $name
     * @return Column
     * @throws ColumnDoesNotExistsException
     */
    public function getColumn($name)
    {
        if ($this->hasColumn($name)) {
            return $this->nameIndexedColumns[$name];
        } else {
            throw new ColumnDoesNotExistsException($name, $this);
        }
    }

    public function hasColumn($name)
    {
        return array_key_exists($name, $this->nameIndexedColumns);
    }

    public function getNames()
    {
        return array_keys($this->nameIndexedColumns);
    }

    public function getIterator()
    {
        return $this->iterator;
    }

    public function isWritable()
    {
        return $this->writable;
    }
}
