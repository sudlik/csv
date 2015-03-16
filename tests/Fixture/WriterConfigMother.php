<?php

namespace Csv\Tests\Fixture;

use Csv\Value\Charset;
use Csv\Value\ContentConfig;
use Csv\Value\CsvConfig;
use Csv\Value\Delimiter;
use Csv\Value\EnclosureConfig;
use Csv\Value\EnclosureCharacter;
use Csv\Value\EnclosureStrategy;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Value\WriteMode;
use Csv\Value\WriterConfig;

class WriterConfigMother
{
    private static function getTestBuilder()
    {
        return new WriterConfigTestBuilder;
    }

    public static function createDefault()
    {
        return self::getTestBuilder()->create();
    }

    public static function createWithoutBom()
    {
        return self::getTestBuilder()->setCharset(Charset::UTF_8_WITHOUT_BOM())->create();
    }

    public static function createWithGivenCharset(Charset $charset)
    {
        return self::getTestBuilder()->setCharset($charset)->create();
    }

    public static function createWithGivenEol(EndOfLine $endOfLine)
    {
        return self::getTestBuilder()->setEndOfLine($endOfLine)->create();
    }

    public static function createWithGivenEnclosureStrategy(EnclosureStrategy $enclosureStrategy)
    {
        return self::getTestBuilder()->setEnclosureStrategy($enclosureStrategy)->create();
    }

    public static function createWithGivenEscape(Escape $escape)
    {
        return self::getTestBuilder()->setEscape($escape)->create();
    }
}
