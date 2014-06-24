<?php

namespace Csv\Writer;

use Csv\Collection\Row;
use Csv\Document;
use Csv\Enum\Charset;
use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;
use Csv\Value\Position;
use SplFileObject;

class DocumentWriter
{
    private $document;
    private $splFileObject;

    public function __construct(Document $document)
    {
        $this->document = $document;
        $this->splFileObject = new SplFileObject($this->document->getFileConfig()->getPath(), 'w');
    }

    public function write()
    {
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

        return $this->splFileObject->fputcsv(
            $data,
            $this->document->getCsvConfig()->getDelimiter(),
            $this->document->getCsvConfig()->getEnclosure()
        );
    }
}