<?php

namespace Csv\Writer;

use Csv\Builder\DocumentBuilder;
use Csv\Collection\Row;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Factory\WriterAdapterFactory;
use Csv\Table\Table;
use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;
use Csv\Value\Position;

/**
 * Class RowWriter
 * @package Csv
 */
class RowWriter
{
    const FIRST_ROW_POSITION = 0;

    /**
     * @var string
     */
    private $bom;

    /**
     * @var Charset
     */
    private $charset;

    /**
     * @var Delimiter
     */
    private $delimiter;

    /**
     * @var Enclosure
     */
    private $enclosure;

    /**
     * @var Charset
     */
    private $utf8;

    /**
     * @var \Csv\Value\VisibleNames
     */
    private $visibleNames;

    /**
     * @var \Csv\Value\WithBom
     */
    private $withBom;

    /**
     * @var \Csv\Adapter\WriterAdapter
     */
    private $writerAdapter;

    /**
     * @var WriterAdapterFactory
     */
    private $writerAdapterFactory;

    /**
     * @param WriterAdapterFactory $writerAdapterFactory
     */
    public function __construct(WriterAdapterFactory $writerAdapterFactory)
    {
        $this->bom = chr(0xef) . chr(0xbb) . chr(0xbf);
        $this->utf8 = Charset::get(Charset::UTF8);
        $this->writerAdapterFactory = $writerAdapterFactory;
    }

    /**
     * @param DocumentBuilder $documentBuilder
     */
    public function write(DocumentBuilder $documentBuilder)
    {
        /** @var \Csv\Document $document */
        $document = $documentBuilder->getDocument();
        $table = $documentBuilder->getTable();
        $rows = $table->getRows();

        $this->writeDocument($document->getCsvConfig(), $document->getFileConfig(), $table);

        $table->registerNamesUpdateCallback(
            function (Row $row) {
                $this->overwriteRow($row, self::FIRST_ROW_POSITION, $this->delimiter, $this->enclosure);
            }
        );

        $table->registerRowCreateCallback(
            function (Row $row) use ($rows) {
                $position = $rows->count() - 1;

                if ($this->visibleNames) {
                    $position += 1;
                }

                $this->writeRow($row, $position, $this->delimiter, $this->enclosure);
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

    /**
     * @param CsvConfig $csvConfig
     * @param FileConfig $fileConfig
     * @param Table $table
     */
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

    /**
     * @param Row $row
     * @param $position
     * @param Delimiter $delimiter
     * @param Enclosure $enclosure
     * @return \Csv\Adapter\WriterAdapter
     */
    private function writeRow(Row $row, $position, Delimiter $delimiter, Enclosure $enclosure)
    {
        if ($this->hasBom($position)) {
            $this->writerAdapter->writeString($this->bom);
        }

        return $this->writerAdapter->writeRow($delimiter, $enclosure, $row);
    }

    /**
     * @param $position
     * @return bool
     */
    private function hasBom($position)
    {
        return
            $position === self::FIRST_ROW_POSITION
            and $this->charset->sameValueAs($this->utf8)
            and $this->withBom->getValue();
    }

    /**
     * @param Row $row
     * @param $position
     * @param Delimiter $delimiter
     * @param Enclosure $enclosure
     * @return \Csv\Adapter\WriterAdapter
     */
    private function overwriteRow(Row $row, $position, Delimiter $delimiter, Enclosure $enclosure)
    {
        return $this->writerAdapter->overwriteRow($delimiter, $enclosure, $row, $position);
    }
}
