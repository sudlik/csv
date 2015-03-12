<?php

namespace Csv\Writer;

class SplStandardWithFractionsEnclosureStrategyWriter extends SplStandardEnclosureStrategyWriter
{
    public function write(array $values)
    {
        $character = $this->getCharacter();
        $escape = $this->getEscape();
        $targets = $this->getTargets();
        $delimiter = $this->getDelimiter();
        $file = $this->getFile();
        $value = array_shift($values);

        if (preg_match('#^\d+,\d+$#', $value) or strpbrk($value, $targets)) {
            $file->fwrite($character . str_replace($character, $escape . $character, $value) . $character);
        } else {
            $file->fwrite($value);
        }

        foreach ($values as $value) {
            if (preg_match('#^\d+,\d+$#', $value) or strpbrk($value, $targets)) {
                $file->fwrite(
                    $delimiter
                    . $character
                    . str_replace($character, $escape . $character, $value)
                    . $character
                );
            } else {
                $file->fwrite($value);
            }

            $file->fflush();
        }
    }
}
