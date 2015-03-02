<?php
namespace Csv\Factory;

use Csv\Value\FilePath;
use Csv\Value\WriteMode;
use SplFileObject;

interface SplFileObjectFromPathAndModeFactory
{
    /**
     * @param FilePath $filePath
     * @param WriteMode $writeMode
     * @return SplFileObject
     */
    public function createFromPathAndMode(FilePath $filePath, WriteMode $writeMode);
}
