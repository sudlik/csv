<?php

namespace Csv\Tests\Unit\Writer;

use Csv\Tests\Double\Collection\NamedWritableColumnCollectionMock;
use Csv\Tests\Double\Writer\WriterMock;
use Csv\Tests\Fixture\WriterConfigMother;
use Csv\Collection\AsciiCollection;
use Csv\Value\Charset;
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
            new WriterMock
        );

        $testedObject->write([]);

        self::assertFileExists($someFilePath);
    }

    /**
     * @test
     */
    public function it_should_write_bom_on_utf8_charset()
    {
        $charset = Charset::UTF_8_WITH_BOM();
        $someFile = $this->createFile();
        $testedObject = new ExtendedSplWriter(
            $someFile,
            WriterConfigMother::createWithGivenCharset($charset),
            new NamedWritableColumnCollectionMock,
            new WriterMock
        );

        $testedObject->write([]);

        self::assertEquals(
            AsciiCollection::bom()->toNative(),
            trim(file_get_contents($someFile->getPathname()))
        );
    }

    private function createFile()
    {
        $someDir = 'someDir/';
        vfsStream::setup($someDir);

        return new SplFileObject(vfsStream::url($someDir . 'someFilename'), WriteMode::OVERWRITE_OR_CREATE);
    }
}
