<?php

namespace Csv\Collection;

use Csv\Cell;
use Csv\Collection;
use Csv\Row;

class RowCollection extends Collection
{
    private $rowSize = 0;

    public function add(Row $row)
    {
        $this->getArrayObject()[] = $row;
        $this->setRowSize($row);

        return $this;
    }

    public function addCollection(self $rowCollection)
    {
        foreach ($rowCollection->getArrayObject() as $item) {
            $this->add($item);
        }

        return $this;
    }

    protected function setRowSize(Row $row)
    {
        $newSize = $row->count();

        if ($this->rowSize !== $newSize) {
            $diff = $newSize - $this->rowSize;

            if ($diff > 0) {
                foreach ($this->getArrayObject() as $row) {
                    for ($i = 0; $i < $diff; $i++) {
                        $row->add(new Cell);
                    }
                }
                $this->rowSize = $newSize;
            } else {
                $add = abs($diff);

                for ($i = 0; $i < $add; $i++) {
                    $row->add(new Cell);
                }
            }
        }

        return $this;
    }
}