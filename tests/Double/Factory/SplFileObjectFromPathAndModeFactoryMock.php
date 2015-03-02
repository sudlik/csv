<?php

namespace Csv\Tests\Double\Factory;

use Csv\Factory\SplFileObjectFromPathAndModeFactory;
use Csv\Tests\Double\SplFileObjectMock;
use Csv\Value\FilePath;
use Csv\Value\WriteMode;

class SplFileObjectFromPathAndModeFactoryMock implements SplFileObjectFromPathAndModeFactory
{
    public function createFromPathAndMode(FilePath $filePath, WriteMode $writeMode)
    {
        return new SplFileObjectMock;
    }
}
