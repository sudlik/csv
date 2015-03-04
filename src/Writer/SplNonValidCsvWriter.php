<?php

namespace Csv\Writer;

use Csv\Collection\NamedWritableColumnCollection;
use Csv\Exception\UnimplementedFeatureException;
use Csv\Value\Charset;
use Csv\Value\EnclosurePositions;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Value\WriterConfig;
use SplFileObject;

class SplNonValidCsvWriter implements Writer
{
    private $file;
    private $delimiter;
    private $enclosure;

    public function __construct(SplFileObject $file, WriterConfig $config, NamedWritableColumnCollection $columns)
    {
        $this->file = $file;
        $this->delimiter = $config->getCsvConfig()->getDelimiter()->getValue();
        $this->enclosure = $config->getCsvConfig()->getEnclosure()->getCharacter()->getValue();

        if (!$config->getContentConfig()->getEndOfLine()->is(EndOfLine::LINE_FEED)) {
            throw new UnimplementedFeatureException;
        }

        if (!$config->getCsvConfig()->getEnclosure()->getPositions()->is(EnclosurePositions::STANDARD)) {
            throw new UnimplementedFeatureException;
        }

        if (!$config->getCsvConfig()->getEscape()->is(Escape::BACKSLASH)) {
            throw new UnimplementedFeatureException;
        }

        if ($config->getContentConfig()->getCharset()->is(Charset::UTF_8_WITH_BOM)) {
            $file->fwrite(chr(0xef) . chr(0xbb) . chr(0xbf));
        }

        if ($columns->isWritable()) {
            $file->fputcsv($columns->getNames(), $this->delimiter, $this->enclosure);
        }
    }

    public function write(array $values)
    {
        $this->file->fputcsv($values, $this->delimiter, $this->enclosure);

        $this->file->fflush();

        return $this;
    }
}
