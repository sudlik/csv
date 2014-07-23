<?php

namespace Csv;

use Csv\Collection\Row;
use Csv\Collection\RowCollection;
use Csv\Value\Cell;
use Csv\Value\Position;

class Table
{
    /**
     * Row with names
     * @var Csv\Collection\Row
     */
    private $names;

    /**
     * Rows with data
     * @var Csv\Collection\RowCollection
     */
    private $rows;

    /**
     * Row size (cells count)
     * @var int
     */
    private $rowSize = 0;

    private $namesUpdateCallbacks = [];

    private $rowCreateCallbacks = [];

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

    public function setName(Cell $cell, Position $position)
    {
        $this->names->set($cell, $position);
        $this->executeNamesUpdateCallbacks();
        $this->update();

        return $this;
    }

    public function addName(Cell $cell)
    {
        $this->names->add($cell);
        $this->executeNamesUpdateCallbacks();
        $this->update();

        return $this;
    }

    public function setRow(Row $row, Position $position)
    {
        $this->rows->set($row, $position);
        $this->executeRowUpdateCallbacks($row, $position);
        $this->update();

        return $this;
    }

    public function addRow(Row $row)
    {
        $this->rows->add($row);
        $this->executeRowCreateCallbacks($row);
        $this->update();

        return $this;
    }

    public function getNames()
    {
        return $this->names;
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function freeze()
    {
        $this->names->freeze();
        $this->rows->freeze();

        return $this;
    }

    public function registerNamesUpdateCallback(callable $callback)
    {
        $this->namesUpdateCallbacks[] = $callback;
    }

    public function registerRowCreateCallback(callable $callback)
    {
        $this->rowCreateCallbacks[] = $callback;
    }

    public function registerRowUpdateCallback(callable $callback)
    {
        $this->rowUpdateCallbacks[] = $callback;
    }

    private function update()
    {
        $this->calculateRowSize();
        $this->createMissingNames();
        $this->createMissingRows();
        $this->createMissingCells();
    }

    private function calculateRowSize()
    {
        $this->rowSize = max($this->rowSize, $this->names->size());

        foreach ($this->rows->all() as $row) {
            $this->rowSize = max($this->rowSize, $row->size());
        }
    }

    private function createMissingNames()
    {
        for ($p = 0; $p < $this->rowSize; $p++) {
            $position = new Position($p);

            if (!$this->names->exists($position)) {
                $this->names->set(new Cell, $position);
                $this->executeNamesUpdateCallbacks();
            }
        }
    }

    private function createMissingRows()
    {
        for ($p = 0; $p < $this->rows->size(); $p++) {
            $position = new Position($p);

            if (!$this->rows->exists($position)) {
                $row = new Row;
                $this->rows->set($row, $position);
                $this->executeRowUpdateCallbacks($row, $position);
            }
        }
    }

    private function createMissingCells()
    {
        foreach ($this->rows->all() as $row) {
            for ($p = 0; $p < $this->rowSize; $p++) {
                $position = new Position($p);

                if (!$row->exists($position)) {
                    $row->set(new Cell, $position);
                    $this->executeRowUpdateCallbacks($row, $position);
                }
            }
        }
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
