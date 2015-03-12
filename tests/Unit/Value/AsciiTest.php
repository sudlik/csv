<?php

namespace Csv\Tests\Unit\Value;

use Csv\Value\Ascii;
use PHPUnit_Framework_TestCase;

class AsciiTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_with_given_value()
    {
        $someName = 'a';

        $result = new Ascii($someName);

        self::assertEquals($someName, $result->getValue());
    }

    /**
     * @test
     */
    public function it_should_create_object_with_given_integer()
    {
        $someInteger = 1;

        $result = Ascii::fromInteger($someInteger);

        self::assertEquals(chr($someInteger), $result->getValue());
    }

    /**
     * @test
     */
    public function it_should_create_object_containing_null()
    {
        $result = Ascii::null();

        self::assertEquals(chr(0), $result->getValue());
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidAsciiException
     */
    public function it_should_throw_exception_when_value_is_invalid()
    {
        $invalidAscii = 'ą';

        new Ascii($invalidAscii);
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidAsciiIntegerException
     */
    public function it_should_throw_exception_when_integer_is_invalid()
    {
        $invalidAsciiInteger = 256;

        Ascii::fromInteger($invalidAsciiInteger);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $ascii = 'b';
        $someAscii = new Ascii($ascii);
        $sameAscii = new Ascii($ascii);

        $result = $someAscii->sameValueAs($sameAscii);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $some = 'a';
        $different = 'b';
        $someAscii = new Ascii($some);
        $differentAscii = new Ascii($different);

        $result = $someAscii->sameValueAs($differentAscii);

        self::assertFalse($result);
    }
}
