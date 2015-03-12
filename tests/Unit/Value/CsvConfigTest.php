<?php

namespace Csv\Tests\Unit\Value;

use Csv\Tests\Fixture\EnclosureConfigMother;
use Csv\Value\CsvConfig;
use Csv\Value\Delimiter;
use Csv\Value\EnclosureCharacter;
use Csv\Value\EnclosureConfig;
use Csv\Value\EnclosureStrategy;
use Csv\Value\Escape;
use PHPUnit_Framework_TestCase;

class CsvConfigTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_wth_given_params()
    {
        $someDelimiter = Delimiter::COLON();
        $someEnclosure = EnclosureConfigMother::createDefault();
        $someEscape = Escape::APOSTROPHE();

        $result = new CsvConfig($someDelimiter, $someEnclosure, $someEscape);

        self::assertTrue($someDelimiter->sameValueAs($result->getDelimiter()));
        self::assertTrue($someEnclosure->sameValueAs($result->getEnclosure()));
        self::assertTrue($someEscape->sameValueAs($result->getEscape()));
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $someDelimiter = Delimiter::COLON();
        $someEnclosure = EnclosureConfigMother::createDefault();
        $someEscape = Escape::APOSTROPHE();
        $testedObject = new CsvConfig($someDelimiter, $someEnclosure, $someEscape);
        $sameCsvConfig = new CsvConfig($someDelimiter, $someEnclosure, $someEscape);

        $result = $testedObject->sameValueAs($sameCsvConfig);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $someDelimiter = Delimiter::COMMA();
        $someEnclosure = EnclosureConfigMother::createDefault();
        $someEscape = Escape::NONE();
        $differentDelimiter = Delimiter::COLON();
        $differentEnclosure = new EnclosureConfig(EnclosureCharacter::GRAVE_ACCENT(), EnclosureStrategy::NONE());
        $differentEscape = Escape::APOSTROPHE();
        $testedObject = new CsvConfig($someDelimiter, $someEnclosure, $someEscape);
        $differentCsvConfig = new CsvConfig($differentDelimiter, $differentEnclosure, $differentEscape);

        $result = $testedObject->sameValueAs($differentCsvConfig);

        self::assertFalse($result);
    }
}
