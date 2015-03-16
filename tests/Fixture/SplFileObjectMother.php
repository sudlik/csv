<?php

namespace Csv\Tests\Fixture;

use Csv\Value\WriteMode;
use org\bovigo\vfs\vfsStream;
use SplFileObject;

class SplFileObjectMother
{
    const ROOT = 'root/';

    public static function createDefault()
    {
        return self::createWithGivenValue('filename');
    }

    public static function createWithGivenValue($filename)
    {
        vfsStream::setup(self::ROOT);

        return new SplFileObject(vfsStream::url(self::ROOT . $filename), WriteMode::OVERWRITE_OR_CREATE);
    }
}
