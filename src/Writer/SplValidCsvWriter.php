<?php

namespace Csv\Writer;

use Csv\Collection\NamedWritableColumnCollection;
use Csv\Exception\InvalidValuesException;
use Csv\Exception\UnimplementedFeatureException;
use Csv\Validator\Validator;
use Csv\Value\Charset;
use Csv\Value\EnclosurePositions;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Value\WriterConfig;
use SplFileObject;

class SplValidCsvWriter implements Writer
{
    private $file;
    private $valuesValidator;
    private $delimiter;
    private $enclosure;

    public function __construct(
        SplFileObject $splFileObject,
        Validator $valuesValidator,
        WriterConfig $writerConfig,
        NamedWritableColumnCollection $columnCollection
    ) {
        $this->file = $splFileObject;
        $this->valuesValidator = $valuesValidator;
        $this->delimiter = $writerConfig->getCsvConfig()->getDelimiter()->getValue();
        $this->enclosure = $writerConfig->getCsvConfig()->getEnclosure()->getCharacter()->getValue();

        if (!$writerConfig->getContentConfig()->getEndOfLine()->is(EndOfLine::LINE_FEED)) {
            throw new UnimplementedFeatureException;
        }

        if (!$writerConfig->getCsvConfig()->getEnclosure()->getPositions()->is(EnclosurePositions::STANDARD)) {
            throw new UnimplementedFeatureException;
        }

        if (!$writerConfig->getCsvConfig()->getEscape()->is(Escape::BACKSLASH)) {
            throw new UnimplementedFeatureException;
        }

        if ($writerConfig->getContentConfig()->getCharset()->is(Charset::UTF_8_WITH_BOM)) {
            $splFileObject->fwrite(chr(0xef) . chr(0xbb) . chr(0xbf));
        }

        if ($columnCollection->isWritable()) {
            $splFileObject->fputcsv($columnCollection->getNames(), $this->delimiter, $this->enclosure);
        }
    }

    public function write(array $values)
    {
        if ($this->valuesValidator->validate($values)) {
            $this->file->fputcsv($values, $this->delimiter, $this->enclosure);
            $this->file->fflush();

            return $this;
        } else {
            throw new InvalidValuesException($values);
        }
    }
}
