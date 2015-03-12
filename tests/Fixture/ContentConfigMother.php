<?php

namespace Csv\Tests\Fixture;

use Csv\Value\Charset;
use Csv\Value\ContentConfig;
use Csv\Value\EndOfLine;
use Csv\Value\WriteMode;

class ContentConfigMother
{
    public static function createDefault()
    {
        return new ContentConfig(Charset::UTF_8_WITH_BOM(), EndOfLine::LINE_FEED(), WriteMode::OVERWRITE_OR_CREATE());
    }
}
