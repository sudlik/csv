<?php

namespace Csv\Tests\Fixture;

use Csv\Value\DirectoryPath;
use Csv\Value\FileExtension;
use Csv\Value\Filename;
use Csv\Value\FilePath;

class FilePathMother
{
    public static function createDefault()
    {
        return new FilePath(
            new DirectoryPath(__DIR__),
            new Filename('someFilename'),
            new FileExtension('someExtension')
        );
    }
}
