<?php
namespace Csv\Collection;

use Csv\Column\Column;
use IteratorAggregate;

interface NamedWritableColumnCollection extends IteratorAggregate
{
    /**
     * @param ColumnCollection $columnCollection
     * @return bool
     */
    public function sameValueAs(NamedWritableColumnCollection $columnCollection);

    /**
     * @param string $name
     * @return Column
     */
    public function getColumn($name);

    /**
     * @param string $name
     * @return bool
     */
    public function hasColumn($name);

    /**
     * @return string[]
     */
    public function getNames();

    /**
     * @return bool
     */
    public function isWritable();

    /**
     * @return string
     */
    public function __toString();
}
