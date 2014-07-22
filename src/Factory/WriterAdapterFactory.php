<?php

namespace Csv\Factory;

use Csv\Value\DirectoryPath;
use Csv\Value\Filename;

interface WriterAdapterFactory
{
    public function create(DirectoryPath $directoryPath, Filename $filename);
}
