<?php
namespace Csv\Collection;

use Csv\Value\Column;
use IteratorAggregate;

interface NamedWritableColumnCollection extends IteratorAggregate
{
    /**
     * @param NamedWritableColumnCollection $columns
     * @return bool
     */
    public function sameValueAs(NamedWritableColumnCollection $columns);

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
