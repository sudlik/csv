<?php

namespace Csv\Tests\Unit\Value;

use Csv\Tests\Fixture\ContentConfigMother;
use Csv\Tests\Fixture\CsvConfigMother;
use Csv\Value\Charset;
use Csv\Value\ContentConfig;
use Csv\Value\CsvConfig;
use Csv\Value\Delimiter;
use Csv\Value\EnclosureCharacter;
use Csv\Value\EnclosureConfig;
use Csv\Value\EnclosureStrategy;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Value\WriteMode;
use Csv\Value\WriterConfig;
use PHPUnit_Framework_TestCase;

class WriterConfigTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_wth_given_params()
    {
        $someCsvConfig = CsvConfigMother::createDefault();
        $someContentConfig = ContentConfigMother::createDefault();

        $result = new WriterConfig($someCsvConfig, $someContentConfig);

        self::assertTrue($someCsvConfig->sameValueAs($result->getCsvConfig()));
        self::assertTrue($someContentConfig->sameValueAs($result->getContentConfig()));
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $someCsvConfig = CsvConfigMother::createDefault();
        $someContentConfig = ContentConfigMother::createDefault();
        $testedObject = new WriterConfig($someCsvConfig, $someContentConfig);
        $differentWriterConfig = new WriterConfig($someCsvConfig, $someContentConfig);

        $result = $testedObject->sameValueAs($differentWriterConfig);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $someCsvConfig = CsvConfigMother::createDefault();
        $someContentConfig = ContentConfigMother::createDefault();
        $testedObject = new WriterConfig($someCsvConfig, $someContentConfig);
        $differentCsvConfig = new CsvConfig(
            Delimiter::COLON(),
            new EnclosureConfig(EnclosureCharacter::APOSTROPHE(), EnclosureStrategy::NONE()),
            Escape::NONE()
        );
        $differentContentConfig = new ContentConfig(
            Charset::ISO_8859_2(),
            EndOfLine::NONE(),
            WriteMode::APPEND_OR_CREATE()
        );
        $differentWriterConfig = new WriterConfig($differentCsvConfig, $differentContentConfig);

        $result = $testedObject->sameValueAs($differentWriterConfig);

        self::assertFalse($result);
    }
}
