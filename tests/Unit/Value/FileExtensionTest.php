<?php

namespace Csv\Tests\Unit\Value;

use Csv\Value\FileExtension;
use PHPUnit_Framework_TestCase;

class FileExtensionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_with_given_value()
    {
        $someFileExtension = 'some_file_extension';

        $result = new FileExtension($someFileExtension);

        self::assertEquals($someFileExtension, $result->getValue());
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidFileExtensionException
     */
    public function it_should_throw_exception_when_value_is_invalid()
    {
        $invalidFileExtension = ' ';

        new FileExtension($invalidFileExtension);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $someExt = 'some_file_extension';
        $someFileExtension = new FileExtension($someExt);
        $sameFileExtension = new FileExtension($someExt);

        $result = $someFileExtension->sameValueAs($sameFileExtension);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $someExt = 'some_file_extension';
        $differentExt = 'different_file_extension';
        $someFileExtension = new FileExtension($someExt);
        $differentFileExtension = new FileExtension($differentExt);

        $result = $someFileExtension->sameValueAs($differentFileExtension);

        self::assertFalse($result);
    }
}
