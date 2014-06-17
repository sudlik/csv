<?php

namespace Csv\Collection;

use Csv\Collection\RowCollection;
use Csv\Row\IndexedRow;

class IndexedRowCollection extends RowCollection
{
    public function set(IndexedRow $indexedRow)
    {
        $this->getArrayObject()[$indexedRow->index()] = $indexedRow;

        $this
            ->setRowSize($indexedRow)
            ->setCollectionSize($indexedRow);

        return $this;
    }

    public function setCollection(self $indexedRowCollection)
    {
        foreach ($indexedRowCollection->getArrayObject() as $item) {
            $this->set($item);
        }

        return $this;
    }

    public function index($index)
    {
        return $this->getArrayObject()->offsetGet($index);
    }

    private function setCollectionSize(IndexedRow $indexedRow)
    {
        if ($indexedRow->index());
    }
}