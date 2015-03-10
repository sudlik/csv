<?php

namespace Csv\Writer;

use Csv\Value\AsciiCharacter;
use Csv\Value\WriterConfig;
use SplFileObject;

class SplStandardEnclosureStrategyWriter implements EnclosureStrategyWriter
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
        $character = $this->character;
        $escape = $this->escape;
        $targets = $this->targets;
        $delimiter = $this->delimiter;
        $value = array_shift($values);

        if (strpbrk($value, $targets)) {
            $this->file->fwrite($character . str_replace($character, $escape . $character, $value) . $character);
        } else {
            $this->file->fwrite($value);
        }

        foreach ($values as $value) {
            if (strpbrk($value, $targets)) {
                $this->file->fwrite(
                    $delimiter
                    . $character
                    . str_replace($character, $escape . $character, $value)
                    . $character
                );
            } else {
                $this->file->fwrite($value);
            }

            $this->file->fflush();
        }
    }
}
