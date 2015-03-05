<?php

namespace Csv\Tests\Unit\Collection;

use Csv\Collection\AssertableColumnCollection;
use Csv\Column\AssertableColumn;
use Csv\Tests\Double\Assertion\StringRepresentableAssertionMock;
use PHPUnit_Framework_TestCase;

class AssertableColumnCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_be_recognize_as_the_same()
    {
        $sameName = 'some name';
        $sameWritable = true;
        $someCollection = new AssertableColumnCollection(
            [new AssertableColumn($sameName, new StringRepresentableAssertionMock)],
            $sameWritable
        );
        $otherCollection = new AssertableColumnCollection(
            [new AssertableColumn($sameName, new StringRepresentableAssertionMock)],
            $sameWritable
        );

        $result = $someCollection->sameValueAs($otherCollection);

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_be_recognize_as_the_different()
    {
        $someWritable = true;
        $differentWritable = true;
        $someCollection = new AssertableColumnCollection(
            [new AssertableColumn('some name', new StringRepresentableAssertionMock)],
            $someWritable
        );
        $differentCollection = new AssertableColumnCollection(
            [new AssertableColumn('different name', new StringRepresentableAssertionMock)],
            $differentWritable
        );

        $result = $someCollection->sameValueAs($differentCollection);

        $this->assertFalse($result);
    }
}
