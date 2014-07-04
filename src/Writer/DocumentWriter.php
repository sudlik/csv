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

        if ($visibleNames) {
            $this->writeRow($this->document->getNames(), true);
        }

        foreach ($this->document->getData()->all() as $k => $row) {
            $this->writeRow($row, !$visibleNames and $k === 0);
        }
    }

    private function writeRow(Row $row, $first = false)
    {
        $data = $row->asArray();

        if ($this->document->getFileConfig()->getWithBom()->getValue() && $first && $data) {
            if ($this->document->getFileConfig()->getCharset()->sameValueAs(Charset::get(Charset::UTF8))) {
                $bom = chr(0xef) . chr(0xbb) . chr(0xbf);
            } else {
                $bom = null;
            }

            if ($bom) {
                reset($data);

                $key = key($data);
                $data[$key] = $bom . $data[$key];
            }
        }

        return $this->writerAdapter->write($data);
    }
}
