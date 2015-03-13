<?php

namespace Csv\Tests\Unit\Value;

use Csv\Value\Filename;
use PHPUnit_Framework_TestCase;

class FilenameTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_with_given_value()
    {
        $someFileName = 'some filename';

        $result = new Filename($someFileName);

        self::assertEquals($someFileName, $result->getValue());
    }

    public function invalidFilenames()
    {
        return [
            ['filename with ' . DIRECTORY_SEPARATOR],
            ['filename with .'],
            ['filename with unprintable character like ' . chr(0)],
            ["filename with vertical whitespace \n"],
        ];
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidFilenameException
     * @dataProvider invalidFilenames
     */
    public function it_should_throw_exception_when_value_is_invalid($invalidFileName)
    {
        new Filename($invalidFileName);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $fileName = 'some filename';
        $someFileName = new Filename($fileName);
        $sameFileName = new Filename($fileName);

        $result = $someFileName->sameValueAs($sameFileName);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $some = 'some filename';
        $different = 'different filename';
        $someFilename = new Filename($some);
        $differentFilename = new Filename($different);

        $result = $someFilename->sameValueAs($differentFilename);

        self::assertFalse($result);
    }
}
