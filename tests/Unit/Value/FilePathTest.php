<?php

namespace Csv\Tests\Unit\Value;

use Csv\Tests\Fixture\DirectoryPathMother;
use Csv\Value\FileExtension;
use Csv\Value\Filename;
use Csv\Value\FilePath;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

class FilePathTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_wth_given_params()
    {
        $someDirectoryPath = DirectoryPathMother::createDefault();
        $someFilename = new Filename('some_filename');
        $someFileExtension = new FileExtension('some_file_extension');

        $result = new FilePath($someDirectoryPath, $someFilename, $someFileExtension);

        self::assertTrue($someDirectoryPath->sameValueAs($result->getDirectoryPath()));
        self::assertTrue($someFilename->sameValueAs($result->getFilename()));
        self::assertTrue($someFileExtension->sameValueAs($result->getFileExtension()));
    }

    /**
     * @test
     */
    public function it_should_create_object_from_native_params()
    {
        $someDir = 'some_directory_path';
        $someDirectoryPath = vfsStream::url($someDir);
        vfsStream::setup($someDir);
        $someFilename = 'some_filename';
        $someFileExtension = 'some_file_extension';

        $result = FilePath::fromNative($someDirectoryPath, $someFilename, $someFileExtension);

        self::assertEquals($someDirectoryPath, $result->getDirectoryPath()->getValue());
        self::assertEquals($someFilename, $result->getFilename()->getValue());
        self::assertEquals($someFileExtension, $result->getFileExtension()->getValue());
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $someDirectoryPath = DirectoryPathMother::createDefault();
        $someFilename = new Filename('some_filename');
        $someFileExtension = new FileExtension('some_file_extension');
        $testedObject = new FilePath($someDirectoryPath, $someFilename, $someFileExtension);
        $sameFilePath = new FilePath($someDirectoryPath, $someFilename, $someFileExtension);

        $result = $testedObject->sameValueAs($sameFilePath);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $someDirectoryPath = DirectoryPathMother::createWithGivenValue('some_directory_path');
        $someFilename = new Filename('some_filename');
        $someFileExtension = new FileExtension('some_file_extension');
        $differentDirectoryPath = DirectoryPathMother::createWithGivenValue('different_directory_path');
        $differentFilename = new Filename('different_filename');
        $differentFileExtension = new FileExtension('different_file_extension');
        $testedObject = new FilePath($someDirectoryPath, $someFilename, $someFileExtension);
        $differentFilePath = new FilePath($differentDirectoryPath, $differentFilename, $differentFileExtension);

        $result = $testedObject->sameValueAs($differentFilePath);

        self::assertFalse($result);
    }
}
