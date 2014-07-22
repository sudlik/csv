<?php

namespace Csv\Writer;

use Csv\Collection\Row;
use Csv\Document;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Factory\WriterAdapterFactory;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;
use SplFileObject;

class DocumentWriter
{
    const FIRST_ROW_POSITION = 0;

    private $bom;
    private $charset;
    private $writerAdapter;
    private $writerAdapterFactory;
    private $utf8;
    private $withBom;

    public function __construct(WriterAdapterFactory $writerAdapterFactory)
    {
        $this->bom = chr(0xef) . chr(0xbb) . chr(0xbf);
        $this->writerAdapterFactory = $writerAdapterFactory;
        $this->utf8 = Charset::get(Charset::UTF8);
    }

    public function write(Document $document)
    {
        $csvConfig = $document->getCsvConfig();
        $delimiter = $csvConfig->getDelimiter();
        $enclosure = $csvConfig->getEnclosure();
        $fileConfig = $document->getFileConfig();
        $table = $document->getTable();
        $visibleNames = $csvConfig->getVisibleNames()->getValue();

        $this->charset = $fileConfig->getCharset();
        $this->withBom = $fileConfig->getWithBom();

        $this->writerAdapter = $this->writerAdapterFactory->create(
            $fileConfig->getDirectoryPath(),
            $fileConfig->getFilename()
        );

        if ($visibleNames) {
            $this->writeRow($table->getNames(), self::FIRST_ROW_POSITION, $delimiter, $enclosure);
        }

        foreach ($table->getRows()->all() as $position => $row) {
            if ($visibleNames) {
                $position += 1;
            }

            $this->writeRow($row, $position, $delimiter, $enclosure);
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
}
