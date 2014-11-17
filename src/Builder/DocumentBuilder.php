<?php

namespace Csv\Builder;

use Csv\Collection\Row;
use Csv\Document;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Factory\DocumentFactory;
use Csv\Factory\FilenameFactory;
use Csv\Factory\VisibleNamesFactory;
use Csv\Factory\WithBomFactory;
use Csv\Table\SafeTable;
use Csv\Table\Table;
use Csv\Table\UnsafeTable;
use Csv\Value\Cell;
use Csv\Value\CsvConfig;
use Csv\Value\DirectoryPath;
use Csv\Value\FileConfig;
use Csv\Value\Filename;
use Csv\Value\Position;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;

/**
 * @package Csv
 */
class DocumentBuilder implements DocumentBuilderInterface
{
    /**
     * Csv charset
     * @var Charset
     */
    private $charset;

    /**
     * Csv delimiter
     * @var Delimiter
     */
    private $delimiter;

    /**
     * Directory path
     * @var DirectoryPath
     */
    private $directoryPath;

    /**
     * Csv enclosure
     * @var Enclosure
     */
    private $enclosure;

    /**
     * Filename with extension but without directory path
     * @var Filename
     */
    private $filename;

    /**
     * Row holder
     * @var Table
     */
    private $table;

    /**
     * Names written in file
     * @var VisibleNames
     */
    private $visibleNames;

    /**
     * File with BOM
     * @var WithBom
     */
    private $withBom;

    /**
     * Create document builder
     * @param string $directoryPath required
     * @param string $filename optional
     * @param bool $safeTable optional
     */
    public function __construct($directoryPath, $filename = null, $safeTable = true)
    {
        $this->directoryPath = new DirectoryPath($directoryPath);

        if ($safeTable) {
            $this->table = new SafeTable;
        } else {
            $this->table = new UnsafeTable;
        }

        if (is_null($filename)) {
            $this->filename = new Filename('document.csv');
        } else {
            $this->filename = new Filename($filename);
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
     * @return \Csv\Document
     */
    public function getDocument()
    {
        if ($this->charset) {
            $charset = $this->charset;
        } else {
            $charset = Charset::get(Charset::UTF8);
        }

        if ($this->delimiter) {
            $delimiter = $this->delimiter;
        } else {
            $delimiter = Delimiter::get(Delimiter::SEMICOLON);
        }

        if ($this->enclosure) {
            $enclosure = $this->enclosure;
        } else {
            $enclosure = Enclosure::get(Enclosure::DOUBLE_QUOTES);
        }

        if ($this->visibleNames) {
            $visibleNames = $this->visibleNames;
        } else {
            $visibleNames = new VisibleNames(true);
        }

        if ($this->withBom) {
            $withBom = $this->withBom;
        } else {
            $withBom = new WithBom(true);
        }

        return new Document(
            new CsvConfig($delimiter, $enclosure, $visibleNames),
            new FileConfig($charset, $this->directoryPath, $this->filename, $withBom),
            $this->table
        );
    }

    /**
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }
}
