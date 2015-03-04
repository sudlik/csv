<?php

namespace Csv\Tests\Unit\Column;

use Csv\Column\AssertableColumn;
use Csv\Tests\Double\Assertion\StringRepresentableAssertionMock;
use PHPUnit_Framework_TestCase;

class ColumnTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_column_wth_given_params()
    {
        $someName = 'some name';
        $someAssertion = new StringRepresentableAssertionMock;

        $result = new AssertableColumn($someName, $someAssertion);

        $this->assertEquals($someName, $result->getName());
        $this->assertEquals($someAssertion, $result->getAssertion());
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidColumnNameException
     */
    public function it_should_throw_exception_when_name_is_invalid()
    {
        $someName = 123;
        $someAssertion = new StringRepresentableAssertionMock;

        new AssertableColumn($someName, $someAssertion);
    }
}
