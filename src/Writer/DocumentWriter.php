<?php

namespace Csv\Writer;

use Csv\Cell;
use Csv\Collection\Row;
use Csv\Enum\Charset;
use Csv\Value\CsvConfig;
use Csv\Value\FileConfig;
use Csv\Value\Position;
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
        $data = $row->asArray();

        if ($this->fileConfig->getWithBom()->toNative() && $first && $data) {
            if ($this->fileConfig->getCharset()->sameValueAs(Charset::get(Charset::UTF8))) {
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

        return $this->splFileObject->fputcsv($data, $this->csvConfig->getDelimiter(), $this->csvConfig->getEnclosure());
    }
}