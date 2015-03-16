<?php

namespace Csv\Tests\Unit\Writer;

use Csv\Tests\Fixture\SplFileObjectMother;
use Csv\Tests\Fixture\WriterConfigMother;
use Csv\Tests\Fixture\WriterConfigTestBuilder;
use Csv\Value\Delimiter;
use Csv\Value\EnclosureCharacter;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Writer\SplStandardEnclosureStrategyWriter;
use PHPUnit_Framework_TestCase;

class SplStandardEnclosureStrategyWriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_file()
    {
        $someFile = SplFileObjectMother::createDefault();
        $testedObject = new SplStandardEnclosureStrategyWriter($someFile, WriterConfigMother::createDefault());

        $testedObject->write([]);

        self::assertFileExists($someFile->getPathname());
    }

    /**
     * @test
     */
    public function it_should_write_values_with_standard_enclosure()
    {
        $someFile = SplFileObjectMother::createDefault();
        $someEnclosureCharacter = EnclosureCharacter::GRAVE_ACCENT;
        $someValues = ['first value', 'second value' . $someEnclosureCharacter];
        $testedObject = new SplStandardEnclosureStrategyWriter(
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
            if (strpbrk($value, $someEnclosureCharacter)) {
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
