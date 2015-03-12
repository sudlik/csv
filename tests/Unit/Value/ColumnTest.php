<?php

namespace Csv\Tests\Unit\Value;

use Csv\Value\Column;
use PHPUnit_Framework_TestCase;

class ColumnTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_object_with_given_value()
    {
        $someName = 'some name';

        $result = new Column($someName);

        self::assertEquals($someName, $result->getName());
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidColumnNameException
     */
    public function it_should_throw_exception_when_value_is_invalid()
    {
        $invalidColumnName = ' ';

        new Column($invalidColumnName);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $someName = 'some name';
        $someColumn = new Column($someName);
        $sameColumn = new Column($someName);

        $result = $someColumn->sameValueAs($sameColumn);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_different()
    {
        $someName = 'some name';
        $differentName = 'different name';
        $someColumn = new Column($someName);
        $differentColumn = new Column($differentName);

        $result = $someColumn->sameValueAs($differentColumn);

        self::assertFalse($result);
    }
}
