<?php

namespace Csv\Adapter;

use Csv\Collection\ColumnCollection;
use Csv\Exception\InvalidValuesException;
use Csv\Exception\UnimplementedFeatureException;
use Csv\Validator\ValuesValidator;
use Csv\Value\Charset;
use Csv\Value\EnclosurePositions;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Value\WriterConfig;
use SplFileObject;

class SplWriterAdapter implements WriterAdapter
{
    private $splFileObject;
    private $valuesValidator;
    private $delimiter;
    private $enclosure;

    public function __construct(
        SplFileObject $splFileObject,
        ValuesValidator $valuesValidator,
        WriterConfig $writerConfig,
        ColumnCollection $columnCollection
    ) {
        $this->splFileObject = $splFileObject;
        $this->valuesValidator = $valuesValidator;
        $this->delimiter = $writerConfig->getCsvConfig()->getDelimiter()->getValue();
        $this->enclosure = $writerConfig->getCsvConfig()->getEnclosure()->getCharacter()->getValue();

        if (!$writerConfig->getContentConfig()->getCharset()->is(Charset::UTF_8())) {
            throw new UnimplementedFeatureException;
        }

        if (!$writerConfig->getContentConfig()->getEndOfLine()->is(EndOfLine::LINE_FEED)) {
            throw new UnimplementedFeatureException;
        }

        if (!$writerConfig->getCsvConfig()->getEnclosure()->getPositions()->is(EnclosurePositions::NECESSARY)) {
            throw new UnimplementedFeatureException;
        }

        if (!$writerConfig->getCsvConfig()->getEscape()->is(Escape::BACKSLASH)) {
            throw new UnimplementedFeatureException;
        }

        if ($writerConfig->getContentConfig()->hasByteOrderMark()) {
            $splFileObject->fwrite(chr(0xef) . chr(0xbb) . chr(0xbf));
            $splFileObject->fflush();
        }

        if ($columnCollection->isWritable()) {
            $this->writeArray($columnCollection->getNames());
        }
    }

    public function write(array $values)
    {
        if ($this->valuesValidator->validate($values)) {
            $this->writeArray($values);
        } else {
            throw new InvalidValuesException;
        }

        return $this;
    }

    private function writeArray(array $values)
    {
        $this->splFileObject->fputcsv($values, $this->delimiter, $this->enclosure);

        $this->splFileObject->fflush();

        return $this;
    }
}
