<?php

namespace Csv\Builder;

use Csv\Cell;
use Csv\Collection\CellCollection;
use Csv\Collection\NamedCellCollection;
use Csv\Collection\RowCollection;
use Csv\Collection\IndexedRowCollection;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosurer;
use Csv\Enum\Escape;
use Csv\Row;
use Csv\ValueObject\DirectoryPath;
use Csv\ValueObject\DocumentConfig;
use Csv\ValueObject\Filename;

/**
 * @package Csv
 */
class DocumentBuilder
{
    /**
     * Charset
     * @var Csv\Enum\Charset
     */
    private $charset;

    /**
     * Escape
     * @var Csv\Enum\Escape
     */
    private $escape;

    /**
     * Enclosure
     * @var Csv\Enum\Enclosure
     */
    private $enclosure;

    /**
     * Delimiter
     * @var Csv\Enum\Delimiter
     */
    private $delimiter;

    /**
     * Directory path
     * @var Csv\ValueObject\DirectoryPath
     */
    private $directoryPath;

    /**
     * Filename
     * @var Csv\ValueObject\Filename
     */
    private $filename;

    /**
     * Cell pointer
     * @var Csv\Cell
     */
    private $cellPointer;

    /**
     * Create document builder
     * @param DirectoryPath $directoryPath required
     * @param Filename $filename required
     */
    public function __construct(DirectoryPath $directoryPath, Filename $filename)
    {
        $this->indexedRowCollection = new IndexedRowCollection;
        $this->directoryPath = $directoryPath;
        $this->filename = $filename;
        $this
            ->delimiter(new Delimiter)
            ->enclosure(new Enclosurer)
            ->escape(new Escape)
            ->charset(new Charset);
    }

    /**
     * Set delimiter character
     * @param Delimiter $delimiter required
     * @return self
     */
    public function delimiter(Delimiter $delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * Set enclosure character
     * @param Enclosure $enclosure required
     * @return self
     */
    public function enclosure(Enclosure $enclosure)
    {
        $this->enclosure = $enclosure;

        return $this;
    }

    /**
     * Set escape character
     * @param Escape $escape required
     * @return self
     */
    public function escape(Escape $escape)
    {
        $this->escape = $escape;

        return $this;
    }

    /**
     * Set charset
     * @param Charset $charset required
     * @return self
     */
    public function charset(Charset $charset)
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * Add row on the bottom of the document
     * @param Row $row required
     * @return self
     */
    public function row(Row $row)
    {
        if ($row instanceof IndexedRow) {
            $this->indexedRowCollection->set($row);
        } else {
            $this->indexedRowCollection->add($row);
        }

        $this->setCellPointer($row);

        return $this;
    }

    /**
     * Add rows on the bottom of the document
     * @param RowCollection $rowCollection required
     * @return self
     */
    public function rows(RowCollection $rowCollection)
    {
        if ($row instanceof IndexedRowCollection) {
            $this->indexedRowCollection->setCollection($rowCollection);
        } else {
            $this->indexedRowCollection->addCollection($rowCollection);
        }

        $this->setCellPointer($this->indexedRowCollection->last());

        return $this;
    }

    /**
     * Add column on the right of the document
     * @param Column $row required
     * @return self
     */
    public function column(Column $column)
    {
        if ($row instanceof NamedColumn) {
            // ...
        } else {
            // ...
        }

        return $this;
    }

    /**
     * Add columns on the right of the document
     * @param ColumnCollection $rowCollection required
     * @return self
     */
    public function columns(ColumnCollection $rowCollection)
    {
        if ($row instanceof NamedColumnCollection) {
            // ...
        } else {
            // ...
        }

        return $this;
    }

    /**
     * Add value to cell
     * @param Value $value required
     * @return self
     */
    public function value(Value $value)
    {
        // Add value to choosen cell
        if ($value instanceof PositionedValue) {
            $row = $this->indexedRowCollection->index($value->getIndex());

            if ($row) {
                $cell = $row->first();

                if ($cell) {
                    $cell->value($value);
                } else {
                    $row->add(new Cell($value));
                }
            } else {
                $this->indexedRowCollection->set((new Row)->add($value));
            }
        // Add value to pointer
        } else {
            $this->cellPointer->value($value);
            // ... set new pointer
        }

        return $this;
    }

    /**
     * Add cells at the end of row
     * @param CellCollection $cellCollection required
     * @return self
     */
    public function values(CellCollection $cellCollection)
    {
        if ($row instanceof NamedCellCollection) {
            // ...
        } else {
            // ...
        }

        return $this;
    }

    /**
     * Get document
     * @return Csv\Document
     */
    public function getDocument()
    {
        return new Document(
            $this->rowCollection,
            new DocumentConfig(
                $this->directoryPath,
                $this->filename,
                $this->delimiter,
                $this->enclosure,
                $this->escape,
                $this->charset
            )
        );
    }

    private function setCellPointer(Row $row)
    {
        $cells = $row->getArrayObject();
        $cell = null;

        for ($i = $cells->count() - 1, $c = 0; $i >= $c; $i--) {
            if (is_null($cells[$i])) {
                $cell = $cells[$i];
            } else {
                break;
            }
        }

        return $cell;
    }
}