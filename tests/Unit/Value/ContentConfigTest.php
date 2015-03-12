<?php

namespace Csv\Tests\Unit\Value;

use Csv\Value\Charset;
use Csv\Value\ContentConfig;
use Csv\Value\EndOfLine;
use Csv\Value\WriteMode;
use PHPUnit_Framework_TestCase;

class ContentConfigTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_wth_given_params()
    {
        $someCharset = Charset::UTF_8_WITH_BOM();
        $someEndOfLine = EndOfLine::CARRIAGE_RETURN();
        $someWriteMode = WriteMode::APPEND();

        $result = new ContentConfig($someCharset, $someEndOfLine, $someWriteMode);

        self::assertTrue($someCharset->is($result->getCharset()));
        self::assertTrue($someEndOfLine->is($result->getEndOfLine()));
        self::assertTrue($someWriteMode->is($result->getWriteMode()));
    }

    /**
     * @test
     */
    public function it_should_create_object_from_native_params()
    {
        $someCharset = Charset::UTF_8_WITH_BOM;
        $someEndOfLine = EndOfLine::CARRIAGE_RETURN;
        $someWriteMode = WriteMode::APPEND;

        $result = ContentConfig::fromNative($someCharset, $someEndOfLine, $someWriteMode);

        self::assertEquals($someCharset, $result->getCharset()->getValue());
        self::assertEquals($someEndOfLine, $result->getEndOfLine()->getValue());
        self::assertEquals($someWriteMode, $result->getWriteMode()->getValue());
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $someCharset = Charset::UTF_8_WITH_BOM();
        $someEndOfLine = EndOfLine::CARRIAGE_RETURN();
        $someWriteMode = WriteMode::APPEND();
        $testedObject = new ContentConfig($someCharset, $someEndOfLine, $someWriteMode);
        $sameContentConfig = new ContentConfig($someCharset, $someEndOfLine, $someWriteMode);

        $result = $testedObject->sameValueAs($sameContentConfig);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $someCharset = Charset::ISO_8859_2();
        $someEndOfLine = EndOfLine::NONE();
        $someWriteMode = WriteMode::APPEND_OR_CREATE();
        $differentCharset = Charset::UTF_8_WITH_BOM();
        $differentEndOfLine = EndOfLine::CARRIAGE_RETURN();
        $differentWriteMode = WriteMode::APPEND();
        $testedObject = new ContentConfig($someCharset, $someEndOfLine, $someWriteMode);
        $differentContentConfig = new ContentConfig($differentCharset, $differentEndOfLine, $differentWriteMode);

        $result = $testedObject->sameValueAs($differentContentConfig);

        self::assertFalse($result);
    }
}
