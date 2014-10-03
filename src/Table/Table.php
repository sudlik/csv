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
interface Table
{
    public function __clone();

    /**
     * @param Cell $cell
     * @param Position $position
     * @return $this
     */
    public function setName(Cell $cell, Position $position);

    /**
     * @param Cell $cell
     * @return $this
     */
    public function addName(Cell $cell);

    /**
     * @param Row $row
     * @param Position $position
     * @return $this
     */
    public function setRow(Row $row, Position $position);

    /**
     * @param Row $row
     * @return $this
     */
    public function addRow(Row $row);

    /**
     * @return Row
     */
    public function getNames();

    /**
     * @return RowCollection
     */
    public function getRows();

    /**
     * @return $this
     */
    public function freeze();

    /**
     * @param callable $callback
     */
    public function registerNamesUpdateCallback(callable $callback);

    /**
     * @param callable $callback
     */
    public function registerRowCreateCallback(callable $callback);

    /**
     * @param callable $callback
     */
    public function registerRowUpdateCallback(callable $callback);
}
