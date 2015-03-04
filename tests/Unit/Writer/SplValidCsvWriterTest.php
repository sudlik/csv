<?php

namespace Csv\Tests\Unit\Writer;

use Csv\Writer\SplValidCsvWriter;
use Csv\Tests\Double\Collection\NamedWritableColumnCollectionMock;
use Csv\Tests\Double\Validator\ValidatorMock;
use Csv\Tests\Fixture\WriterConfigMother;
use Csv\Value\EndOfLine;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;
use SplFileObject;

class SplValidCsvWriterTest extends PHPUnit_Framework_TestCase
{
    private $filePath;

    /**
     * @test
     */
    public function it_should_write_file_at_given_path()
    {
        $givenFilePath = $this->createFilePath();
        $testedObject = $this->createSplValidCsvWriterWithGivenFilePath($givenFilePath);
        $someContent = [];

        $testedObject->write($someContent);

        $this->assertFileExists($givenFilePath);
    }

    /**
     * @test
     * @depends it_should_write_file_at_given_path
     */
    public function it_should_write_given_content()
    {
        $testedObject = $this->createSplValidCsvWriter();
        $givenContent = 'test';

        $testedObject->write([$givenContent]);

        $this->assertFileEqualsContent($givenContent);
    }

    private function createSplValidCsvWriterWithGivenFilePath($someFilePath)
    {
        return new SplValidCsvWriter(
            new SplFileObject($someFilePath, 'w+'),
            new ValidatorMock,
            WriterConfigMother::createWithoutBom(),
            new NamedWritableColumnCollectionMock
        );
    }

    private function createSplValidCsvWriter($someFilePath = null)
    {
        if (is_null($someFilePath)) {
            $someFilePath = $this->createFilePath();
        }

        return new SplValidCsvWriter(
            new SplFileObject($someFilePath, 'w+'),
            new ValidatorMock,
            WriterConfigMother::createWithoutBom(),
            new NamedWritableColumnCollectionMock
        );
    }

    private function createFilePath()
    {
        if (!$this->filePath) {
            $someDir = 'someDir/';
            $this->filePath = vfsStream::url($someDir . 'someFilename');

            vfsStream::setup($someDir);
        }

        return $this->filePath;
    }

    private function assertFileEqualsContent($givenContent)
    {
        $this->assertEquals($givenContent . EndOfLine::LINE_FEED, file_get_contents($this->createFilePath()));
    }
}
