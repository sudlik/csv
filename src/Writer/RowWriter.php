<?php

namespace Csv\Writer;

use Csv\Builder\DocumentBuilder;
use Csv\Collection\Row;
use Csv\Document;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Factory\WriterAdapterFactory;
use Csv\Table;
use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;

class RowWriter
{
    const FIRST_ROW_POSITION = 0;

    private $bom;
    private $charset;
    private $delimiter;
    private $enclosure;
    private $utf8;
    private $visibleNames;
    private $withBom;
    private $writerAdapter;
    private $writerAdapterFactory;

    public function __construct(WriterAdapterFactory $writerAdapterFactory)
    {
        $this->bom = chr(0xef) . chr(0xbb) . chr(0xbf);
        $this->utf8 = Charset::get(Charset::UTF8);
        $this->writerAdapterFactory = $writerAdapterFactory;
    }

    public function write(DocumentBuilder $documentBuilder)
    {
        $document = $documentBuilder->getDocument();
        $table = $documentBuilder->getTable();

        $this->writeDocument($document->getCsvConfig(), $document->getFileConfig(), $table);

        $table->registerNamesUpdateCallback(
            function (Row $row) {
                $this->overwriteRow($row, self::FIRST_ROW_POSITION, $this->delimiter, $this->enclosure);
            }
        );

        $table->registerRowCreateCallback(
            function (Row $row, Position $position) {
                $p = $position->getValue();

                if ($this->visibleNames) {
                    $p += 1;
                }

                $this->writeRow($row, $p, $this->delimiter, $this->enclosure);
            }
        );

        $table->registerRowUpdateCallback(
            function (Row $row, Position $position) {
                $p = $position->getValue();

                if ($this->visibleNames) {
                    $p += 1;
                }

                $this->overwriteRow($row, $p, $this->delimiter, $this->enclosure);
            }
        );
    }

    private function writeDocument(CsvConfig $csvConfig, FileConfig $fileConfig, Table $table)
    {
        $this->delimiter = $csvConfig->getDelimiter();
        $this->enclosure = $csvConfig->getEnclosure();
        $this->visibleNames = $csvConfig->getVisibleNames()->getValue();
        $this->charset = $fileConfig->getCharset();
        $this->withBom = $fileConfig->getWithBom();

        $this->writerAdapter = $this->writerAdapterFactory->createWithWritePlus(
            $fileConfig->getDirectoryPath(),
            $fileConfig->getFilename()
        );

        if ($this->visibleNames) {
            $this->writeRow($table->getNames(), self::FIRST_ROW_POSITION, $this->delimiter, $this->enclosure);
        }

        foreach ($table->getRows()->all() as $position => $row) {
            if ($this->visibleNames) {
                $position += 1;
            }

            $this->writeRow($row, $position, $this->delimiter, $this->enclosure);
        }
    }

    private function writeRow(Row $row, $position, Delimiter $delimiter, Enclosure $enclosure)
    {
        if ($this->hasBom($position)) {
            $this->writerAdapter->writeString($this->bom);
        }

        return $this->writerAdapter->writeRow($delimiter, $enclosure, $row);
    }

    private function hasBom($position)
    {
        return
            $position === self::FIRST_ROW_POSITION
            and $this->charset->sameValueAs($this->utf8)
            and $this->withBom->getValue();
    }

    private function overwriteRow(Row $row, $position, Delimiter $delimiter, Enclosure $enclosure)
    {
        return $this->writerAdapter->overwriteRow($delimiter, $enclosure, $row, $position);
    }
}
