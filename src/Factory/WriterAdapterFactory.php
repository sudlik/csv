<?php

namespace Csv\Factory;

use Csv\Value\DirectoryPath;
use Csv\Value\Filename;

interface WriterAdapterFactory
{
    public function createWithWrite(DirectoryPath $directoryPath, Filename $filename);

    public function createWithWritePlus(DirectoryPath $directoryPath, Filename $filename);
}
