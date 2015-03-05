<?php

namespace Csv\Tests\Unit\Value;

use Csv\Value\Column;
use PHPUnit_Framework_TestCase;

class ColumnTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_column_wth_given_params()
    {
        $someName = 'some name';

        $result = new Column($someName);

        $this->assertEquals($someName, $result->getName());
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidColumnNameException
     */
    public function it_should_throw_exception_when_name_is_invalid()
    {
        $someName = 123;

        new Column($someName);
    }

    /**
     * @test
     */
    public function it_should_recognize_object_as_same()
    {
        $someName = 'some name';
        $someColumn = new Column($someName);
        $anotherColumn = new Column($someName);

        $result = $someColumn->sameValueAs($anotherColumn);

        $this->assertTrue($result);
    }
}
