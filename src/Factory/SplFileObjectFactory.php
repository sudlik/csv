<?php

namespace Csv\Factory;

use Csv\Value\FilePath;
use Csv\Value\WriteMode;
use SplFileObject;

class SplFileObjectFactory implements SplFileObjectFromPathAndModeFactory
{
    public function createFromPathAndMode(FilePath $filePath, WriteMode $writeMode)
    {
        return new SplFileObject($filePath->toNative(), $writeMode->getValue());
    }
}
