<?php

namespace Csv\Table;

use Csv\Collection\Row;
use Csv\Collection\RowCollection;
use Csv\Value\Cell;
use Csv\Value\Position;

/**
 * Class Table
 * @package Csv
 */
class UnsafeTable implements Table
{
    /**
     * Row with names
     * @var Row
     */
    private $names;

    /**
     * Rows with data
     * @var RowCollection
     */
    private $rows;

    /** @var callable[] */
    private $namesUpdateCallbacks = [];

    /** @var callable[] */
    private $rowCreateCallbacks = [];

    /** @var callable[] */
    private $rowUpdateCallbacks = [];

    public function __construct()
    {
        $this->names = new Row;
        $this->rows = new RowCollection;
    }

    public function __clone()
    {
        $this->names = clone $this->names;
        $this->rows = clone $this->rows;
    }

    /**
     * @param Cell $cell
     * @param Position $position
     * @return $this
     */
    public function setName(Cell $cell, Position $position)
    {
        $this->names->set($cell, $position);
        $this->executeNamesUpdateCallbacks();

        return $this;
    }

    /**
     * @param Cell $cell
     * @return $this
     */
    public function addName(Cell $cell)
    {
        $this->names->add($cell);
        $this->executeNamesUpdateCallbacks();

        return $this;
    }

    /**
     * @param Row $row
     * @param Position $position
     * @return $this
     */
    public function setRow(Row $row, Position $position)
    {
        $this->rows->set($row, $position);
        $this->executeRowUpdateCallbacks($row, $position);

        return $this;
    }

    /**
     * @param Row $row
     * @return $this
     */
    public function addRow(Row $row)
    {
        $this->rows->add($row);
        $this->executeRowCreateCallbacks($row);

        return $this;
    }

    /**
     * @return Row
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @return RowCollection
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return $this
     */
    public function freeze()
    {
        $this->names->freeze();
        $this->rows->freeze();

        return $this;
    }

    /**
     * @param callable $callback
     */
    public function registerNamesUpdateCallback(callable $callback)
    {
        $this->namesUpdateCallbacks[] = $callback;
    }

    /**
     * @param callable $callback
     */
    public function registerRowCreateCallback(callable $callback)
    {
        $this->rowCreateCallbacks[] = $callback;
    }

    /**
     * @param callable $callback
     */
    public function registerRowUpdateCallback(callable $callback)
    {
        $this->rowUpdateCallbacks[] = $callback;
    }

    private function executeNamesUpdateCallbacks()
    {
        foreach ($this->namesUpdateCallbacks as $callback) {
            $callback($this->getNames());
        }
    }

    private function executeRowCreateCallbacks(Row $row)
    {
        foreach ($this->rowCreateCallbacks as $callback) {
            $callback($row);
        }
    }

    private function executeRowUpdateCallbacks(Row $row, Position $position)
    {
        foreach ($this->rowUpdateCallbacks as $callback) {
            $callback($row, $position);
        }
    }
}
