<?php

namespace Csv\Tests\Double\Factory;

use Csv\Factory\SplFileObjectFromPathAndModeFactory;
use Csv\Value\FilePath;
use Csv\Value\WriteMode;
use SplTempFileObject;

class SplFileObjectFromPathAndModeFactoryMock implements SplFileObjectFromPathAndModeFactory
{
    public function createFromPathAndMode(FilePath $filePath, WriteMode $writeMode)
    {
        return new SplTempFileObject;
    }
}
