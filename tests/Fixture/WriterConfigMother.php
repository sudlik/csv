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
    public static function createDefault()
    {
        return self::create(Charset::UTF_8_WITH_BOM(), null, null, null);
    }

    public static function createWithoutBom()
    {
        return self::create(Charset::UTF_8_WITHOUT_BOM(), null, null, null);
    }

    public static function createWithGivenCharset(Charset $charset)
    {
        return self::create($charset, null, null, null);
    }

    public static function createWithGivenEol(EndOfLine $endOfLine)
    {
        return self::create(null, $endOfLine, null, null);
    }

    public static function createWithGivenEnclosureStrategy(EnclosureStrategy $enclosureStrategy)
    {
        return self::create(null, null, $enclosureStrategy, null);
    }

    public static function createWithGivenEscape(Escape $escape)
    {
        return self::create(null, null, null, $escape);
    }

    private static function create(
        Charset $charset = null,
        EndOfLine $endOfLine = null,
        EnclosureStrategy $enclosureStrategy = null,
        Escape $escape = null
    ) {
        if (is_null($charset)) {
            $charset = Charset::UTF_8_WITH_BOM();
        }

        if (is_null($endOfLine)) {
            $endOfLine = EndOfLine::LINE_FEED();
        }

        if (is_null($enclosureStrategy)) {
            $enclosureStrategy = EnclosureStrategy::STANDARD();
        }

        if (is_null($escape)) {
            $escape = Escape::BACKSLASH();
        }

        return new WriterConfig(
            new CsvConfig(
                Delimiter::COLON(),
                new EnclosureConfig(EnclosureCharacter::APOSTROPHE(), $enclosureStrategy),
                $escape
            ),
            new ContentConfig($charset, $endOfLine, WriteMode::OVERWRITE_OR_CREATE())
        );
    }
}
