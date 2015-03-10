<?php

namespace Csv\Writer;

use Csv\Value\CsvConfig;
use SplFileObject;

class SplAllEnclosureStrategyWriter implements EnclosureStrategyWriter
{
    private $file;
    private $delimiter;
    private $character;
    private $escape;

    public function __construct(SplFileObject $file, CsvConfig $config)
    {
        $this->file = $file;
        $this->delimiter = $config->getDelimiter()->getValue();
        $this->escape = $config->getEscape()->getValue();
        $this->character = $config->getEnclosure()->getCharacter()->getValue();
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

            $this->file->fwrite(
                $this->character
                . str_replace($this->character, $this->escape . $this->character, $value)
                . $this->character
            );
        }
    }
}
