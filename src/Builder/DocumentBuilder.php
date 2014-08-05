<?php

namespace Csv\Builder;

use Csv\Collection\Row;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Factory\DocumentFactory;
use Csv\Factory\FilenameFactory;
use Csv\Table;
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
     * Filename with extension but without directory path
     * @var Csv\Value\Filename
     */
    private $filename;

    /**
     * Row holder
     * @var Table
     */
    private $table;

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
        $this->directoryPath = new DirectoryPath($directoryPath);
        $filenameFactory = new FilenameFactory;
        $this->table = new Table;

        if (is_null($filename)) {
            $this->filename = $filenameFactory->create();
        } else {
            $this->filename = $filenameFactory->create($filename);
        }
    }

    /**
     * @param $charset
     * @return $this
     */
    public function charset($charset)
    {
        $this->charset = Charset::get($charset);

        return $this;
    }

    /**
     * @param $delimiter
     * @return $this
     */
    public function delimiter($delimiter)
    {
        $this->delimiter = Delimiter::get($delimiter);

        return $this;
    }

    /**
     * @param $enclosure
     * @return $this
     */
    public function enclosure($enclosure)
    {
        $this->enclosure = Enclosure::get($enclosure);

        return $this;
    }

    /**
     * @param $visibleNames
     * @return $this
     */
    public function visibleNames($visibleNames)
    {
        $this->visibleNames = new VisibleNames($visibleNames);

        return $this;
    }

    /**
     * @param $withBom
     * @return $this
     */
    public function withBom($withBom)
    {
        $this->withBom = new WithBom($withBom);

        return $this;
    }

    /**
     * @param null $name
     * @param null $position
     * @return $this
     */
    public function name($name = null, $position = null)
    {
        if (is_null($position)) {
            $this->table->addName(new Cell($name));
        } else {
            $this->table->setName(new Cell($name), new Position($position));
        }

        return $this;
    }

    /**
     * @param $names
     * @return $this
     */
    public function names($names)
    {
        foreach ($names as $name) {
            if (is_array($name)) {
                $this->table->setName(new Cell($name[0]), new Position($name[1]));
            } else {
                $this->table->addName(new Cell($name));
            }
        }

        return $this;
    }

    /**
     * @param array $cells
     * @param null $position
     * @return $this
     */
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
            $this->table->addRow($row);
        } else {
            $this->table->setRow($row, new Position($position));
        }

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

        return $documentFactory->create($this->table);
    }

    /**
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }
}
