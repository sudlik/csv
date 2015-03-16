<?php

namespace Csv\Writer;

use Csv\Collection\NamedWritableColumnCollection;
use Csv\Exception\UnimplementedFeatureException;
use Csv\Collection\AsciiCollection;
use Csv\Value\Charset;
use Csv\Value\EnclosureStrategy;
use Csv\Value\Escape;
use Csv\Value\WriterConfig;
use SplFileObject;

class SplWriter implements Writer
{
    private $file;
    private $delimiter;
    private $enclosure;

    public function __construct(SplFileObject $file, WriterConfig $config, NamedWritableColumnCollection $columns)
    {
        $csvConfig = $config->getCsvConfig();

        $this->file = $file;
        $this->delimiter = $csvConfig->getDelimiter()->getValue();
        $this->enclosure = $csvConfig->getEnclosure()->getCharacter()->getValue();

        if ($config->getContentConfig()->getEndOfLine()->getValue() !== PHP_EOL) {
            throw new UnimplementedFeatureException($config->getContentConfig()->getEndOfLine());
        }

        if (!$csvConfig->getEnclosure()->getStrategy()->is(EnclosureStrategy::STANDARD)) {
            throw new UnimplementedFeatureException($csvConfig->getEnclosure()->getStrategy());
        }

        if (!$csvConfig->getEscape()->is(Escape::BACKSLASH)) {
            throw new UnimplementedFeatureException($csvConfig->getEscape());
        }

        if ($config->getContentConfig()->getCharset()->is(Charset::UTF_8_WITH_BOM)) {
            $file->fwrite(AsciiCollection::bom()->toNative());
        }

        if ($columns->isWritable()) {
            $file->fputcsv($columns->getNames(), $this->delimiter, $this->enclosure);
        }
    }

    public function write(array $values)
    {
        $this->file->fputcsv($values, $this->delimiter, $this->enclosure);

        return $this;
    }

    protected function getFile()
    {
        return $this->file;
    }

    protected function getDelimiter()
    {
        return $this->delimiter;
    }

    protected function getEnclosure()
    {
        return $this->enclosure;
    }
}
