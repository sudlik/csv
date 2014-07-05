<?php

namespace Csv\Factory;

use Csv\Document;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Factory\VisibleNamesFactory;
use Csv\Factory\WithBomFactory;
use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;

class DocumentFactory
{
    private $charset;
    private $delimiter;
    private $directoryPath;
    private $enclosure;
    private $filename;
    private $visibleNames;
    private $withBom;

    public function __construct($directoryPath, $filename)
    {
        $this->charset = Charset::get(Charset::UTF8);
        $this->delimiter = Delimiter::get(Delimiter::SEMICOLON);
        $this->directoryPath = $directoryPath;
        $this->enclosure = Enclosure::get(Enclosure::DOUBLE_QUOTES);
        $this->filename = $filename;
        $this->visibleNames = (new VisibleNamesFactory)->create();
        $this->withBom = (new WithBomFactory)->create();
    }

    public function setCharset($charset)
    {
        $this->charset = $charset;

        return $this;
    }

    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;

        return $this;
    }

    public function setVisibleNames($visibleNames)
    {
        $this->visibleNames = $visibleNames;

        return $this;
    }

    public function setWithBom($withBom)
    {
        $this->withBom = $withBom;

        return $this;
    }

    public function create($names, $data)
    {
        return new Document(
            new CsvConfig($this->delimiter, $this->enclosure, $this->visibleNames),
            new FileConfig($this->charset, $this->directoryPath, $this->filename, $this->withBom),
            $names,
            $data
        );
    }
}
