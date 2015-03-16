<?php

namespace Csv\Writer;

use Csv\Collection\NamedWritableColumnCollection;
use Csv\Collection\AsciiCollection;
use Csv\Value\Charset;
use Csv\Value\EndOfLine;
use Csv\Value\WriterConfig;
use SplFileObject;

class ExtendedSplWriter implements Writer
{
    private $endOfLine;
    private $file;
    private $writer;

    public function __construct(
        SplFileObject $file,
        WriterConfig $config,
        NamedWritableColumnCollection $columns,
        Writer $writer
    ) {
        $this->writer = $writer;
        $this->file = $file;
        $this->endOfLine = $config->getContentConfig()->getEndOfLine()->getValue();

        if ($config->getContentConfig()->getCharset()->is(Charset::UTF_8_WITH_BOM)) {
            $file->fwrite(AsciiCollection::bom()->toNative());
        }

        if ($columns->isWritable()) {
            $this->write($columns->getNames());
        }
    }

    public function write(array $values)
    {
        $this->writer->write($values);

        if ($this->endOfLine !== EndOfLine::NONE) {
            $this->file->fwrite($this->endOfLine);
        }

        return $this;
    }
}
