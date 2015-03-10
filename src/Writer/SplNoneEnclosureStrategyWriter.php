<?php

namespace Csv\Writer;

use Csv\Value\Delimiter;
use SplFileObject;

class SplNoneEnclosureStrategyWriter implements EnclosureStrategyWriter
{
    private $file;
    private $delimiter;

    public function __construct(SplFileObject $file, Delimiter $delimiter)
    {
        $this->file = $file;
        $this->delimiter = $delimiter->getValue();
    }

    public function write(array $values)
    {
        $this->file->fwrite(implode($this->delimiter, $values));
    }
}
