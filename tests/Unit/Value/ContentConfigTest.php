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

        self::assertEquals($someCharset, $result->getCharset());
        self::assertEquals($someEndOfLine, $result->getEndOfLine());
        self::assertEquals($someWriteMode, $result->getWriteMode());
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $someCharset = Charset::UTF_8_WITH_BOM();
        $someEndOfLine = EndOfLine::CARRIAGE_RETURN();
        $someWriteMode = WriteMode::APPEND();
        $anotherCharset = Charset::UTF_8_WITH_BOM();
        $anotherEndOfLine = EndOfLine::CARRIAGE_RETURN();
        $anotherWriteMode = WriteMode::APPEND();
        $testedObject = new ContentConfig($someCharset, $someEndOfLine, $someWriteMode);
        $sameContentConfig = new ContentConfig($anotherCharset, $anotherEndOfLine, $anotherWriteMode);

        $result = $testedObject->sameValueAs($sameContentConfig);

        self::assertTrue($result);
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
}
