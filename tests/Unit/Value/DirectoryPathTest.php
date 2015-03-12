<?php

namespace Csv\Tests\Unit\Value;

use Csv\Value\DirectoryPath;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

class DirectoryPathTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_with_given_value()
    {
        $dir = 'some_directory_path';
        vfsStream::setup($dir);
        $someDirectoryPath = vfsStream::url($dir);

        $result = new DirectoryPath($someDirectoryPath);

        self::assertEquals($someDirectoryPath, $result->getValue());
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidDirectoryPathException
     */
    public function it_should_throw_exception_when_value_is_invalid()
    {
        $notExistingDirectory = 'not/existing/directory';

        new DirectoryPath($notExistingDirectory);
    }

    /**
     * @test
     * @expectedException \Csv\Exception\DirectoryIsUnwritableException
     */
    public function it_should_throw_exception_when_directory_is_unwritable()
    {
        $dir = 'unwritable/directory';
        vfsStream::setup($dir);
        $unwritableDirectory = vfsStream::url($dir);

        chmod($unwritableDirectory, 0400);

        new DirectoryPath($unwritableDirectory);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $dir = 'some_directory_path';
        vfsStream::setup($dir);
        $someDir = vfsStream::url($dir);
        $someDirectoryPath = new DirectoryPath($someDir);
        $sameDirectoryPath = new DirectoryPath($someDir);

        $result = $someDirectoryPath->sameValueAs($sameDirectoryPath);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $root = 'root/';
        vfsStream::setup($root);
        $some = vfsStream::url($root . 'some_directory_path');
        mkdir($some);
        $someDirectoryPath = new DirectoryPath($some);
        $different = vfsStream::url($root . 'different_directory_path');
        mkdir($different);
        $differentDirectoryPath = new DirectoryPath($different);

        $result = $someDirectoryPath->sameValueAs($differentDirectoryPath);

        self::assertFalse($result);
    }
}
