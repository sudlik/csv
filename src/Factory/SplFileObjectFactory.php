<?php

namespace Csv\Factory;

use Csv\Value\FilePath;
use Csv\Value\WriteMode;
use SplFileObject;

class SplFileObjectFactory
{
    public function create(FilePath $filePath, WriteMode $writeMode)
    {
        return new SplFileObject($filePath->toNative(), $writeMode->getValue());
    }
}
