<?php

namespace Csv\Writer;

use Csv\Value\AsciiCharacter;
use Csv\Value\WriterConfig;
use SplFileObject;

class SplStandardWithFractionsEnclosureStrategyWriter implements EnclosureStrategyWriter
{
    private $file;
    private $delimiter;
    private $character;
    private $targets;

    public function __construct(SplFileObject $file, WriterConfig $config)
    {
        $this->file = $file;
        $this->delimiter = $config->getCsvConfig()->getDelimiter()->getValue();
        $this->escape = $config->getCsvConfig()->getEscape()->getValue();
        $this->character = $config->getCsvConfig()->getEnclosure()->getCharacter()->getValue();

        $this->targets = AsciiCharacter::null()
            . $this->delimiter
            . $this->escape
            . $this->character
            . $config->getContentConfig()->getEndOfLine()->getValue();
    }

    public function write(array $values)
    {
        $first = true;
        foreach ($values as $value) {
            if ($first) {
                $first = false;
            } else {
                $this->file->fwrite($this->delimiter);
            }

            if (preg_match('#^\d+,\d+$#', $value) or strpbrk($value, $this->targets)) {
                $this->file->fwrite(
                    $this->character
                    . str_replace($this->character, $this->escape . $this->character, $value)
                    . $this->character
                );
            } else {
                $this->file->fwrite($value);
            }
        }
    }
}
