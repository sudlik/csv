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

    public function __construct()
    {
        $this->names = new Row;
        $this->rows = new RowCollection;
    }

    public function setName(Cell $cell, Position $position)
    {
        $this->names->set($cell, $position);
        $this->update();

        return $this;
    }

    public function addName(Cell $cell)
    {
        $this->names->add($cell);
        $this->update();

        return $this;
    }

    public function setRow(Row $row, Position $position)
    {
        $this->rows->set($row, $position);
        $this->update();

        return $this;
    }

    public function addRow(Row $row)
    {
        $this->rows->add($row);
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

    private function update()
    {
        $this->rowSize = max($this->rowSize, $this->names->size());

        foreach ($this->rows->all() as $row) {
            $this->rowSize = max($this->rowSize, $row->size());
        }

        for ($i = 0; $i < $this->rowSize; $i++) {
            $pos = new Position($i);

            if (!$this->names->exists($pos)) {
                $this->names->set(new Cell, $pos);
            }
        }

        for ($i = 0; $i < $this->rows->size(); $i++) {
            $pos = new Position($i);

            if (!$this->rows->exists($pos)) {
                $this->rows->set(new Row, $pos);
            }
        }

        foreach ($this->rows->all() as $row) {
            for ($i = 0; $i < $this->rowSize; $i++) {
                $pos = new Position($i);

                if (!$row->exists($pos)) {
                    $row->set(new Cell, $pos);
                }
            }
        }
    }
}
