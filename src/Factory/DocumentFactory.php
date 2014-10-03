<?php

namespace Csv\Factory;

use Csv\Document;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Table\Table;
use Csv\Value\CsvConfig;
use Csv\Value\DirectoryPath;
use Csv\Value\FileConfig;
use Csv\Value\Filename;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;

/**
 * Class DocumentFactory
 * @package Csv
 */
class DocumentFactory
{
    /**
     * @var Charset
     */
    private $charset;

    /**
     * @var Delimiter
     */
    private $delimiter;

    /**
     * @var DirectoryPath
     */
    private $directoryPath;

    /**
     * @var Enclosure
     */
    private $enclosure;

    /**
     * @var Filename
     */
    private $filename;

    /**
     * @var VisibleNames
     */
    private $visibleNames;

    /**
     * @var WithBom
     */
    private $withBom;

    /**
     * @param DirectoryPath $directoryPath
     * @param Filename $filename
     */
    public function __construct(DirectoryPath $directoryPath, Filename $filename)
    {
        $this->charset = Charset::get(Charset::UTF8);
        $this->delimiter = Delimiter::get(Delimiter::SEMICOLON);
        $this->directoryPath = $directoryPath;
        $this->enclosure = Enclosure::get(Enclosure::DOUBLE_QUOTES);
        $this->filename = $filename;
        $this->visibleNames = (new VisibleNamesFactory)->create();
        $this->withBom = (new WithBomFactory)->create();
    }


    /**
     * @param Charset $charset
     * @return $this
     */
    public function setCharset(Charset $charset)
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * @param Delimiter $delimiter
     * @return $this
     */
    public function setDelimiter(Delimiter $delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * @param Enclosure $enclosure
     * @return $this
     */
    public function setEnclosure(Enclosure $enclosure)
    {
        $this->enclosure = $enclosure;

        return $this;
    }

    /**
     * @param VisibleNames $visibleNames
     * @return $this
     */
    public function setVisibleNames(VisibleNames $visibleNames)
    {
        $this->visibleNames = $visibleNames;

        return $this;
    }

    /**
     * @param WithBom $withBom
     * @return $this
     */
    public function setWithBom(WithBom $withBom)
    {
        $this->withBom = $withBom;

        return $this;
    }

    /**
     * @param Table $table
     * @return Document
     */
    public function create(Table $table)
    {
        return new Document(
            new CsvConfig($this->delimiter, $this->enclosure, $this->visibleNames),
            new FileConfig($this->charset, $this->directoryPath, $this->filename, $this->withBom),
            $table
        );
    }
}
