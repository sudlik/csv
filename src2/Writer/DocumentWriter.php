<?php

namespace Csv;

use Csv\ValueObject\DocumentConfigValueObject;
use CSv\Row;
use SplFileObject;

class DocumentWriter
{
    private $documentConfigValueObject;
    private $splFileObject;
    
    public function __construct(DocumentConfigValueObject $documentConfigValueObject)
    {
        $this->documentConfigValueObject = $documentConfigValueObject;
        $this->splFileObject = new SplFileObject($documentConfigValueObject->getPath(), 'w');

        if ($documentConfigValueObject->getCharset() === CharserEnum::UTF8) {
            $this->bom = chr(0xef) . chr(0xbb) . chr(0xbf);
        }
    }

    public function write(Row $row)
    {
        $cell = $row->first();
        if ($this->bom && $cell) {
            $cell->setValue($this->bom . $cell->getValue());
            $this->bom = '';
        }

        return $this->splFileObject->fputcsv(
            $row->asArray(),
            $this->documentConfigValueObject->getDelimiter(),
            $this->documentConfigValueObject->getEnclosure()
        );
    }
}