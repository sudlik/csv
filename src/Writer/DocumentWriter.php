<?php

namespace Csv\Writer;

use Csv\Adapter\WriterAdapter;
use Csv\Collection\Row;
use Csv\Document;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;

/**
 * Class DocumentWriter
 * @package Csv
 */
class DocumentWriter extends Writer
{
    /**
     * @param Document $document
     */
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

        $this->writerAdapter = $this->writerAdapterFactory->createWithWrite(
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

    /**
     * @param Row $row
     * @param $position
     * @param Delimiter $delimiter
     * @param Enclosure $enclosure
     * @return WriterAdapter
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
}
