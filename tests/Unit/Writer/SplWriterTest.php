<?php

namespace Csv\Tests\Unit\Writer;

use Csv\Tests\Double\Collection\NamedWritableColumnCollectionMock;
use Csv\Tests\Fixture\WriterConfigMother;
use Csv\Value\AsciiString;
use Csv\Value\Charset;
use Csv\Value\EnclosureStrategy;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Value\WriteMode;
use Csv\Writer\SplWriter;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;
use SplFileObject;

class SplWriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_file()
    {
        $someDir = 'someDir/';
        vfsStream::setup($someDir);
        $someFilePath = vfsStream::url($someDir . 'someFilename');
        $testedObject = new SplWriter(
            new SplFileObject($someFilePath, WriteMode::OVERWRITE_OR_CREATE),
            WriterConfigMother::createDefault(),
            new NamedWritableColumnCollectionMock
        );

        $testedObject->write([]);

        self::assertFileExists($someFilePath);
    }

    /**
     * @test
     * @expectedException \Csv\Exception\UnimplementedFeatureException
     */
    public function it_should_throw_exception_on_non_standard_eol()
    {
        $nonStandardEol = EndOfLine::LINE_FEED_CARRIAGE_RETURN();

        new SplWriter(
            $this->createFile(),
            WriterConfigMother::createWithGivenEol($nonStandardEol),
            new NamedWritableColumnCollectionMock
        );
    }

    /**
     * @test
     * @expectedException \Csv\Exception\UnimplementedFeatureException
     */
    public function it_should_throw_exception_on_non_standard_enclosure_strategy()
    {
        $nonStandardEnclosureStrategy = EnclosureStrategy::ALL();

        new SplWriter(
            $this->createFile(),
            WriterConfigMother::createWithGivenEnclosureStrategy($nonStandardEnclosureStrategy),
            new NamedWritableColumnCollectionMock
        );
    }

    /**
     * @test
     * @expectedException \Csv\Exception\UnimplementedFeatureException
     */
    public function it_should_throw_exception_on_non_standard_escape()
    {
        $nonStandardEscape = Escape::GRAVE_ACCENT();

        new SplWriter(
            $this->createFile(),
            WriterConfigMother::createWithGivenEscape($nonStandardEscape),
            new NamedWritableColumnCollectionMock
        );
    }

    /**
     * @test
     */
    public function it_should_write_bom_on_utf8_charset()
    {
        $charset = Charset::UTF_8_WITH_BOM();
        $someFile = $this->createFile();
        $testedObject = new SplWriter(
            $someFile,
            WriterConfigMother::createWithGivenCharset($charset),
            new NamedWritableColumnCollectionMock
        );

        $testedObject->write([]);

        self::assertEquals(AsciiString::bom()->toNative(), trim(file_get_contents($someFile->getPathname())));
    }

    /**
     * @test
     */
    public function it_should_write_columns_names()
    {
        $someNames = ['firstName' => null, 'secondName' => null];
        $someColumns = new NamedWritableColumnCollectionMock($someNames, true);
        $someFile = $this->createFile();
        $someConfig = WriterConfigMother::createWithoutBom();
        $testedObject = new SplWriter($someFile, $someConfig, $someColumns);

        $testedObject->write([]);

        self::assertEquals(
            implode($someConfig->getCsvConfig()->getDelimiter()->getValue(), array_keys($someNames)),
            trim(file_get_contents($someFile->getPathname()))
        );
    }

    /**
     * @test
     */
    public function it_should_write_given_data()
    {
        $someFile = $this->createFile();
        $someConfig = WriterConfigMother::createWithoutBom();
        $testedObject = new SplWriter($someFile, $someConfig, new NamedWritableColumnCollectionMock);
        $someData = ['firstColumn', 'secondColumn'];

        $testedObject->write($someData);

        self::assertEquals(
            implode($someConfig->getCsvConfig()->getDelimiter()->getValue(), $someData),
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
