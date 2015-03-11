<?php

namespace Csv\Tests\Unit\Writer;

use Csv\Tests\Double\Collection\NamedWritableColumnCollectionMock;
use Csv\Tests\Double\Writer\EnclosureStrategyWriterMock;
use Csv\Tests\Fixture\WriterConfigMother;
use Csv\Value\WriteMode;
use Csv\Writer\ExtendedSplWriter;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;
use SplFileObject;

class ExtendedSplWriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_file()
    {
        $someDir = 'someDir/';
        vfsStream::setup($someDir);
        $someFilePath = vfsStream::url($someDir . 'someFilename');
        $testedObject = new ExtendedSplWriter(
            new SplFileObject($someFilePath, WriteMode::OVERWRITE_OR_CREATE),
            WriterConfigMother::createDefault(),
            new NamedWritableColumnCollectionMock,
            new EnclosureStrategyWriterMock
        );

        $testedObject->write([]);

        self::assertFileExists($someFilePath);
    }
}
