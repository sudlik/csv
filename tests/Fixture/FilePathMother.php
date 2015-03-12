<?php

namespace Csv\Tests\Fixture;

use Csv\Value\FileExtension;
use Csv\Value\Filename;
use Csv\Value\FilePath;

class FilePathMother
{
    public static function createDefault()
    {
        return new FilePath(
            DirectoryPathMother::createDefault(),
            new Filename('someFilename'),
            new FileExtension('someExtension')
        );
    }
}
