<?php

namespace Csv\Builder;

use Csv\Cell;
use Csv\Collection\RowCollection;
use Csv\Content;
use Csv\Document;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Row;
use Csv\Value\CsvConfig;
use Csv\Value\DirectoryPath;
use Csv\Value\FileConfig;
use Csv\Value\Filename;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;

/**
 * @package Csv
 */
class DocumentBuilder
{
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
    public function __construct($directoryPath, $filename)
    {
        $this->directoryPath = new DirectoryPath($directoryPath);
        $this->filename = new Filename($filename);
        $this->charset = Charset::get(Charset::UTF8);
        $this->delimiter = Delimiter::get(Delimiter::SEMICOLON);
        $this->enclosure = Enclosure::get(Enclosure::DOUBLE_QUOTES);
        $this->rowCollection = new RowCollection;
        $this->names = new Row;
        $this->visibleNames = new VisibleNames(true);
        $this->withBom = new WithBom(true);
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

    public function name($name = null)
    {
        if (is_array($name)) {
            foreach ($name as $v) {
                $this->names->add(new Cell(new Content($v)));
            }
        } else {
            $this->names->add(new Cell(new Content($name)));
        }

        $count = $this->names->count();
        $this->rowSize = max($this->rowSize, $count);

        if ($count < $this->rowSize) {
            for ($i = 0, $l = $this->rowSize - $count; $i < $l; $i++) {
                $this->names->add(new Cell(new Content));
            }
        }

        foreach ($this->rowCollection->all() as $row) {
            $rowCount = $row->count();
            for ($i = 0, $l = $this->rowSize - $rowCount; $i < $l; $i++) {
                $row->add(new Cell(new Content));
            }
        }

        return $this;
    }

    public function row(array $cells = null)
    {
        $row = new Row;

        if ($cells) {
            $count = count($cells);
            $this->rowSize = max($this->rowSize, $count);

            foreach ($cells as $cell) {
                $row->add(new Cell(new Content($cell)));
            }

            for ($i = 0, $l = $this->rowSize - $count; $i < $l; $i++) {
                $row->add(new Cell(new Content));
            }
        } else {
            $row->add(new Cell(new Content));

            for ($i = 1, $l = $this->rowSize; $i < $l; $i++) {
                $row->add(new Cell(new Content));
            }
        }

        $this->rowCollection->add($row);

        $namesCount = $this->names->count();
        for ($i = 0, $l = $this->rowSize - $namesCount; $i < $l; $i++) {
            $this->names->add(new Cell(new Content));
        }

        foreach ($this->rowCollection->all() as $row) {
            $rowCount = $row->count();
            for ($i = 0, $l = $this->rowSize - $rowCount; $i < $l; $i++) {
                $row->add(new Cell(new Content));
            }
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
            new CsvConfig($this->delimiter, $this->enclosure, $this->visibleNames),
            new FileConfig($this->charset, $this->directoryPath, $this->filename, $this->withBom),
            $this->names,
            $this->rowCollection
        );
    }
}