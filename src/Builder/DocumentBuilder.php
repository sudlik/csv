<?php

namespace Csv\Builder;

use Csv\Collection\Row;
use Csv\Collection\RowCollection;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Factory\DocumentFactory;
use Csv\Factory\FilenameFactory;
use Csv\Value\Cell;
use Csv\Value\DirectoryPath;
use Csv\Value\Position;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;

/**
 * @package Csv
 */
class DocumentBuilder
{
    /**
     * Csv charset
     * @var Csv\Enum\Charset
     */
    private $charset;

    /**
     * Csv delimiter
     * @var Csv\Enum\Delimiter
     */
    private $delimiter;

    /**
     * Directory path
     * @var Csv\Value\DirectoryPath
     */
    private $directoryPath;

    /**
     * Csv enclosure
     * @var Csv\Enum\Enclosure
     */
    private $enclosure;

    /**
     * Filename
     * @var Csv\Value\Filename
     */
    private $filename;

    /**
     * Row size (cells count)
     * @var int
     */
    private $rowSize = 0;

    /**
     * Row with names
     * @var Csv\Row
     */
    private $names;

    /**
     * Names written in file
     * @var Csv\Value\VisibleNames
     */
    private $visibleNames;

    /**
     * File with BOM
     * @var Csv\Value\WithBom
     */
    private $withBom;

    /**
     * Create document builder
     * @param string $directoryPath required
     * @param string $filename required
     */
    public function __construct($directoryPath, $filename = null)
    {
        $this->data = new RowCollection;
        $this->directoryPath = new DirectoryPath($directoryPath);
        $this->names = new Row;

        $filenameFactory = new FilenameFactory;
        if (is_null($filename)) {
            $this->filename = $filenameFactory->create();
        } else {
            $this->filename = $filenameFactory->create($filename);
        }
    }

    public function charset($charset)
    {
        $this->charset = Charset::get($charset);

        return $this;
    }

    public function delimiter($delimiter)
    {
        $this->delimiter = Delimiter::get($delimiter);

        return $this;
    }

    public function enclosure($enclosure)
    {
        $this->enclosure = Enclosure::get($enclosure);

        return $this;
    }

    public function visibleNames($visibleNames)
    {
        $this->visibleNames = new VisibleNames($visibleNames);

        return $this;
    }

    public function withBom($withBom)
    {
        $this->withBom = new WithBom($withBom);

        return $this;
    }

    public function name($name = null, $position = null)
    {
        if (is_null($position)) {
            $this->names->add(new Cell($name));
        } else {
            $this->names->set(new Cell($name), new Position($position));
        }

        $this->update();

        return $this;
    }

    public function names($names)
    {
        foreach ($names as $name) {
            if (is_array($name)) {
                $this->names->set(new Cell($name[0]), new Position($name[1]));
            } else {
                $this->names->add(new Cell($name));
            }
        }

        $this->update();

        return $this;
    }

    public function row(array $cells = null, $position = null)
    {
        $row = new Row;

        if ($cells) {
            foreach ($cells as $cell) {
                $row->add(new Cell($cell));
            }
        } else {
            $row->add(new Cell);
        }

        if (is_null($position)) {
            $this->data->add($row);
        } else {
            $this->data->set($row, new Position($position));
        }

        $this->update();

        return $this;
    }

    /**
     * Get document
     * @return Csv\Document
     */
    public function getDocument()
    {
        $documentFactory = new DocumentFactory($this->directoryPath, $this->filename);

        if ($this->charset) {
            $documentFactory->setCharset($this->charset);
        }
        if ($this->delimiter) {
            $documentFactory->setDelimiter($this->delimiter);
        }
        if ($this->enclosure) {
            $documentFactory->setEnclosure($this->enclosure);
        }
        if ($this->visibleNames) {
            $documentFactory->setVisibleNames($this->visibleNames);
        }
        if ($this->withBom) {
            $documentFactory->setWithBom($this->withBom);
        }

        return $documentFactory->create($this->names, $this->data);
    }

    private function update()
    {
        $this->rowSize = max($this->rowSize, $this->names->size());

        foreach ($this->data->all() as $row) {
            $this->rowSize = max($this->rowSize, $row->size());
        }

        for ($i = 0; $i < $this->rowSize; $i++) {
            $pos = new Position($i);

            if (!$this->names->exists($pos)) {
                $this->names->set(new Cell, $pos);
            }
        }

        for ($i = 0; $i < $this->data->size(); $i++) {
            $pos = new Position($i);

            if (!$this->data->exists($pos)) {
                $this->data->set(new Row, $pos);
            }
        }

        foreach ($this->data->all() as $row) {
            for ($i = 0; $i < $this->rowSize; $i++) {
                $pos = new Position($i);

                if (!$row->exists($pos)) {
                    $row->set(new Cell, $pos);
                }
            }
        }
    }
}
