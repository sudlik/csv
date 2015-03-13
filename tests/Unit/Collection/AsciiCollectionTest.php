<?php

namespace Csv\Tests\Unit\Collection;

use Csv\Collection\AsciiCollection;
use Csv\Value\Ascii;
use PHPUnit_Framework_TestCase;
use stdClass;

class AsciiCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_collection_with_given_arguments()
    {
        $someAscii = [new Ascii('a')];

        $result = new AsciiCollection($someAscii);

        self::assertEquals($someAscii, $result->getIterator()->getArrayCopy());
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidAsciiException
     */
    public function it_should_throw_exception_on_invalid_object()
    {
        $invalidColumn = [new StdClass];

        new AsciiCollection($invalidColumn);
    }

    /**
     * @test
     */
    public function it_should_be_recognize_as_the_same()
    {
        $sameName = 'a';
        $someCollection = new AsciiCollection([new Ascii($sameName)]);
        $anotherCollection = new AsciiCollection( [new Ascii($sameName)]);

        $result = $someCollection->sameValueAs($anotherCollection);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_be_recognize_as_the_different()
    {
        $someCollection = new AsciiCollection([new Ascii('a')]);
        $differentCollection = new AsciiCollection( [new Ascii('b')]);

        $result = $someCollection->sameValueAs($differentCollection);

        self::assertFalse($result);
    }
}
