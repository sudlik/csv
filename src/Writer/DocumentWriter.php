<?php

namespace Csv\Writer;

use Csv\Adapter\SplCsvWriterAdapter;
use Csv\Collection\Row;
use Csv\Document;
use Csv\Enum\Charset;
use SplFileObject;

class DocumentWriter
{
    private $document;
    private $writerAdapter;

    public function setWriterAdapter(CsvWriterAdapterInterface $writerAdapter)
    {
        $this->writerAdapter = $writerAdapter;

        return $this;
    }

    public function write(Document $document)
    {
        $this->document = $document;

        if (!$this->writerAdapter) {
            $this->writerAdapter = new SplCsvWriterAdapter(
                new SplFileObject($this->document->getFileConfig()->getPath(), 'w'),
                $this->document->getCsvConfig()->getDelimiter(),
                $this->document->getCsvConfig()->getEnclosure()
            );
        }

        $visibleNames = $this->document->getCsvConfig()->getVisibleNames()->getValue();
        $table = $this->document->getTable();

        if ($visibleNames) {
            $this->writeRow($table->getNames(), true);
        }

        foreach ($table->getRows()->all() as $k => $row) {
            $this->writeRow($row, !$visibleNames and $k === 0);
        }
    }

    private function writeRow(Row $row, $first = false)
    {
        $data = $row->asArray();

        if ($this->document->getFileConfig()->getWithBom()->getValue() && $first) {
            if ($this->document->getFileConfig()->getCharset()->sameValueAs(Charset::get(Charset::UTF8))) {
                $this->writerAdapter->writeBom(chr(0xef) . chr(0xbb) . chr(0xbf));
            } else {
                $bom = null;
            }
        }

        return $this->writerAdapter->write($data);
    }
}
