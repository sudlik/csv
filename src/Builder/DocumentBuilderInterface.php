<?php
namespace Csv\Builder;

use Csv\Table\Table;

/**
 * @package Csv
 */
interface DocumentBuilderInterface
{
    /**
     * @param $charset
     * @return $this
     */
    public function charset($charset);

    /**
     * @param $delimiter
     * @return $this
     */
    public function delimiter($delimiter);

    /**
     * @param $enclosure
     * @return $this
     */
    public function enclosure($enclosure);

    /**
     * @param $visibleNames
     * @return $this
     */
    public function visibleNames($visibleNames);

    /**
     * @param $withBom
     * @return $this
     */
    public function withBom($withBom);

    /**
     * @param null $name
     * @param null $position
     * @return $this
     */
    public function name($name = null, $position = null);

    /**
     * @param $names
     * @return $this
     */
    public function names($names);

    /**
     * @param array $cells
     * @param null $position
     * @return $this
     */
    public function row(array $cells = null, $position = null);

    /**
     * Get document
     * @return \Csv\Document
     */
    public function getDocument();

    /**
     * @return Table
     */
    public function getTable();
}
