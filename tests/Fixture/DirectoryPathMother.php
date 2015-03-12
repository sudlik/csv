<?php

namespace Csv\Tests\Fixture;

use Csv\Value\DirectoryPath;
use org\bovigo\vfs\vfsStream;

class DirectoryPathMother
{
    const ROOT = 'root/';

    public static function createDefault()
    {
        return self::createWithGivenValue('directory_path');
    }

    public static function createWithGivenValue($directoryPath)
    {
        vfsStream::setup(self::ROOT);

        $directoryPathUrl = vfsStream::url(self::ROOT . $directoryPath);

        mkdir($directoryPathUrl);

        return new DirectoryPath($directoryPathUrl);
    }
}
