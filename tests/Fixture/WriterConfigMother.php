<?php

namespace Csv\Tests\Fixture;

use Csv\Value\Charset;
use Csv\Value\ContentConfig;
use Csv\Value\CsvConfig;
use Csv\Value\Delimiter;
use Csv\Value\Enclosure;
use Csv\Value\EnclosureCharacter;
use Csv\Value\EnclosurePositions;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Value\WriteMode;
use Csv\Value\WriterConfig;

class WriterConfigMother
{
    public static function createDefault()
    {
        return self::create(Charset::UTF_8_WITH_BOM());
    }

    public static function createWithoutBom()
    {
        return self::create(Charset::UTF_8_WITHOUT_BOM());
    }

    private static function create(Charset $charset)
    {
        return new WriterConfig(
            new CsvConfig(
                Delimiter::COLON(),
                new Enclosure(EnclosureCharacter::APOSTROPHE(), EnclosurePositions::STANDARD()),
                Escape::BACKSLASH()
            ),
            new ContentConfig($charset, EndOfLine::LINE_FEED(), WriteMode::OVERWRITE_OR_CREATE())
        );
    }
}
