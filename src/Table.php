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

    public function setName(Cell $cell, Position $position)
    {
        $this->names->set($cell, $position);
        $this->update();
        $this->executeNamesUpdateCallbacks();

        return $this;
    }

    public function addName(Cell $cell)
    {
        $this->names->add($cell);
        $this->update();
        $this->executeNamesUpdateCallbacks();

        return $this;
    }

    public function setRow(Row $row, Position $position)
    {
        $this->rows->set($row, $position);
        $this->update();
        $this->executeRowUpdateCallbacks($row, $position);

        return $this;
    }

    public function addRow(Row $row)
    {
        $this->rows->add($row);
        $this->update();
        $this->executeRowCreateCallbacks($row);

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

    public function registerNamesUpdateCallback(callable $callback)
    {
        $this->namesUpdateCallbacks[] = $callback;
    }

    public function executeNamesUpdateCallbacks()
    {
        foreach ($this->namesUpdateCallbacks as $callback) {
            $callback($this->getNames());
        }
    }

    public function registerRowCreateCallback(callable $callback)
    {
        $this->rowCreateCallbacks[] = $callback;
    }

    public function executeRowCreateCallbacks(Row $row, Position $position)
    {
        foreach ($this->rowCreateCallbacks as $callback) {
            $callback($row, $position);
        }
    }

    public function registerRowUpdateCallback(callable $callback)
    {
        $this->rowUpdateCallbacks[] = $callback;
    }

    public function executeRowUpdateCallbacks(Row $row, Position $position)
    {
        foreach ($this->rowUpdateCallbacks as $callback) {
            $callback($row, $position);
        }
    }
}
