<?php

namespace Csv\Tests\Unit\Writer;

use Csv\Tests\Fixture\CsvConfigMother;
use Csv\Tests\Fixture\SplFileObjectMother;
use Csv\Value\CsvConfig;
use Csv\Value\Delimiter;
use Csv\Value\EnclosureCharacter;
use Csv\Value\EnclosureConfig;
use Csv\Value\EnclosureStrategy;
use Csv\Value\Escape;
use Csv\Writer\SplAllEnclosureStrategyWriter;
use PHPUnit_Framework_TestCase;

class SplAllEnclosureStrategyWriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_file()
    {
        $someFile = SplFileObjectMother::createDefault();
        $testedObject = new SplAllEnclosureStrategyWriter($someFile, CsvConfigMother::createDefault());

        $testedObject->write([]);

        self::assertFileExists($someFile->getPathname());
    }

    /**
     * @test
     */
    public function it_should_write_values_with_enclosure()
    {
        $someFile = SplFileObjectMother::createDefault();
        $someValues = ['first value', 'second value'];
        $someEnclosure = EnclosureCharacter::APOSTROPHE;
        $testedObject = new SplAllEnclosureStrategyWriter(
            $someFile,
            new CsvConfig(
                Delimiter::NONE(),
                new EnclosureConfig(
                    EnclosureCharacter::fromNative($someEnclosure),
                    EnclosureStrategy::ALL()
                ),
                Escape::NONE()
            )
        );

        $testedObject->write($someValues);

        self::assertEquals(
            $someEnclosure . implode($someEnclosure . $someEnclosure, $someValues) . $someEnclosure,
            trim(file_get_contents($someFile->getPathname()))
        );
    }
}
