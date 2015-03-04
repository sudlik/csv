<?php

namespace Csv\Tests\Unit\Collection;

use Csv\Collection\ColumnCollection;
use Csv\Column\AssertableColumn;
use Csv\Tests\Double\Assertion\StringRepresentableAssertionMock;
use PHPUnit_Framework_TestCase;

class ColumnCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_collection_with_given_arguments()
    {
        $someColumns = [new AssertableColumn('some name', new StringRepresentableAssertionMock())];
        $isWritable = true;

        $result = new ColumnCollection($someColumns, $isWritable);

        $this->assertEquals($someColumns, $result->getIterator()->getArrayCopy());
        $this->assertEquals($isWritable, $result->isWritable());
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidWritableException
     */
    public function it_should_throw_invalid_writable_exception()
    {
        $someColumns = [new AssertableColumn('some name', new StringRepresentableAssertionMock())];
        $isWritable = 'not boolean value';

        new ColumnCollection($someColumns, $isWritable);
    }

    /**
     * @test
     * @expectedException \Csv\Exception\ColumnAlreadyExistsException
     */
    public function it_should_throw_column_already_exists_exception()
    {
        $duplicatedColumns = [
            new AssertableColumn('duplicated name', new StringRepresentableAssertionMock()),
            new AssertableColumn('duplicated name', new StringRepresentableAssertionMock()),
        ];
        $isWritable = true;

        new ColumnCollection($duplicatedColumns, $isWritable);
    }

    /**
     * @test
     */
    public function it_should_be_recognize_as_the_same()
    {
        $sameName = 'some name';
        $sameWritable = true;
        $someCollection = new ColumnCollection(
            [new AssertableColumn($sameName, new StringRepresentableAssertionMock())],
            $sameWritable
        );
        $otherCollection = new ColumnCollection(
            [new AssertableColumn($sameName, new StringRepresentableAssertionMock())],
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
        $someCollection = new ColumnCollection(
            [new AssertableColumn('some name', new StringRepresentableAssertionMock())],
            $someWritable
        );
        $differentCollection = new ColumnCollection(
            [new AssertableColumn('different name', new StringRepresentableAssertionMock())],
            $differentWritable
        );

        $result = $someCollection->sameValueAs($differentCollection);

        $this->assertFalse($result);
    }
}
