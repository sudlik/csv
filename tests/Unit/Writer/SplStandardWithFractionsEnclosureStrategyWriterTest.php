<?php

namespace Csv\Tests\Unit\Writer;

use Csv\Tests\Fixture\SplFileObjectMother;
use Csv\Tests\Fixture\WriterConfigMother;
use Csv\Tests\Fixture\WriterConfigTestBuilder;
use Csv\Value\Delimiter;
use Csv\Value\EnclosureCharacter;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Writer\SplStandardWithFractionsEnclosureStrategyWriter;
use PHPUnit_Framework_TestCase;

class SplStandardWithFractionsEnclosureStrategyWriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_file()
    {
        $someFile = SplFileObjectMother::createDefault();
        $testedObject = new SplStandardWithFractionsEnclosureStrategyWriter(
            $someFile, WriterConfigMother::createDefault()
        );

        $testedObject->write([]);

        self::assertFileExists($someFile->getPathname());
    }

    /**
     * @test
     */
    public function it_should_write_values_with_enclosure_on_fractions()
    {
        $someFile = SplFileObjectMother::createDefault();
        $someEnclosureCharacter = EnclosureCharacter::GRAVE_ACCENT;
        $someValues = ['first value', 'second value' . $someEnclosureCharacter, '1,2'];
        $testedObject = new SplStandardWithFractionsEnclosureStrategyWriter(
            $someFile,
            (new WriterConfigTestBuilder)
                ->setDelimiter(Delimiter::NONE())
                ->setEnclosureCharacter(EnclosureCharacter::fromNative($someEnclosureCharacter))
                ->setEndOfLine(EndOfLine::NONE())
                ->setEscape(Escape::NONE())
                ->create()
        );

        $testedObject->write($someValues);

        $expected = '';
        foreach ($someValues as $value) {
            if (
                preg_match(SplStandardWithFractionsEnclosureStrategyWriter::FRACTION_PATTERN, $value)
                or strpbrk($value, $someEnclosureCharacter)
            ) {
                $expected .= $someEnclosureCharacter . $value . $someEnclosureCharacter;
            } else {
                $expected .= $value;
            }
        }
        self::assertEquals(
            $expected,
            trim(file_get_contents($someFile->getPathname()))
        );
    }
}
