<?php

namespace Csv\Tests\Unit\Writer;

use Csv\Tests\Fixture\SplFileObjectMother;
use Csv\Value\Delimiter;
use Csv\Writer\SplNoneEnclosureStrategyWriter;
use PHPUnit_Framework_TestCase;

class SplNoneEnclosureStrategyWriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_file()
    {
        $someFile = SplFileObjectMother::createDefault();
        $testedObject = new SplNoneEnclosureStrategyWriter($someFile, Delimiter::NONE());

        $testedObject->write([]);

        self::assertFileExists($someFile->getPathname());
    }

    /**
     * @test
     */
    public function it_should_write_values_without_enclosure()
    {
        $someFile = SplFileObjectMother::createDefault();
        $someValues = ['first value', 'second value'];
        $testedObject = new SplNoneEnclosureStrategyWriter($someFile, Delimiter::NONE());

        $testedObject->write($someValues);

        self::assertEquals(implode($someValues), trim(file_get_contents($someFile->getPathname())));
    }
}
