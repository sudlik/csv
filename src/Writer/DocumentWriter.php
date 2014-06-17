<?php

namespace Csv\Writer;

use Csv\Enum\Charset;
use Csv\Row;
use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;
use SplFileObject;

class DocumentWriter
{
    private $csvConfig;
    private $fileConfig;
    private $splFileObject;

    public function __construct(CsvConfig $csvConfig, FileConfig $fileConfig)
    {
        $this->csvConfig = $csvConfig;
        $this->fileConfig = $fileConfig;
        $this->splFileObject = new SplFileObject($fileConfig->getPath(), 'w');
    }

    public function write(Row $row, $first = false)
    {
        if ($this->fileConfig->getWithBom()->getValue() && $first && $row->first()) {
            if ($this->fileConfig->getCharset()->sameValueAs(Charset::get(Charset::UTF8))) {
                $bom = chr(0xef) . chr(0xbb) . chr(0xbf);
            } else {
                $bom = null;
            }

            if ($bom) {
                $content = $row->first()->getContent();
                $content->setValue($bom . $content->getValue());
            }
        }

        return $this->splFileObject->fputcsv(
            $row->asArray(),
            $this->csvConfig->getDelimiter(),
            $this->csvConfig->getEnclosure()
        );
    }
}