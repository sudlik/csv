<?php

namespace Csv;

use Csv\ValueObject\DocumentConfigValueObject;
use Csv\Writer;

class Document
{
    private $documentConfigValueObject;
    
    public function __construct(RowCollection $rowCollection, DocumentConfigValueObject $documentConfigValueObject)
    {
        $this->rowCollection = $rowCollection;
        $this->documentConfigValueObject = $documentConfigValueObject;
    }

    public function write()
    {
        $documentWriter = new DocumentWriter($this->documentConfigValueObject);

        foreach ($this->rowCollection as $row) {
            $documentWriter->execute($row);
        }
    }
}