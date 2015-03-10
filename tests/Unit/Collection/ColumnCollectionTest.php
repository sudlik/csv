<?php

namespace Csv\Tests\Unit\Collection;

use Csv\Collection\ColumnCollection;
use Csv\Value\Column;
use PHPUnit_Framework_TestCase;

class ColumnCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_collection_with_given_arguments()
    {
        $someColumns = [new Column('some name')];
        $isWritable = true;

        $result = new ColumnCollection($someColumns, $isWritable);

        self::assertEquals($someColumns, $result->getIterator()->getArrayCopy());
        self::assertEquals($isWritable, $result->isWritable());
    }

    /**
     * @test
     * @expectedException \Csv\Exception\InvalidWritableException
     */
    public function it_should_throw_invalid_writable_exception()
    {
        $someColumns = [new Column('some name')];
        $isWritable = 'not boolean value';

        new ColumnCollection($someColumns, $isWritable);
    }

    /**
     * @test
     * @expectedException \Csv\Exception\ColumnAlreadyExistsException
     */
    public function it_should_throw_column_already_exists_exception()
    {
        $duplicatedColumns = [new Column('duplicated name'), new Column('duplicated name'),];
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
        $someCollection = new ColumnCollection([new Column($sameName)], $sameWritable);
        $otherCollection = new ColumnCollection( [new Column($sameName)], $sameWritable);

        $result = $someCollection->sameValueAs($otherCollection);

        self::assertTrue($result);
    }

    /**
     * @test
     */
    public function it_should_be_recognize_as_the_different()
    {
        $someWritable = true;
        $differentWritable = true;
        $someCollection = new ColumnCollection([new Column('some name')], $someWritable);
        $differentCollection = new ColumnCollection([new Column('different name')], $differentWritable);

        $result = $someCollection->sameValueAs($differentCollection);

        self::assertFalse($result);
    }

    /**
     * @test
     */
    public function it_should_return_column_by_the_name()
    {
        $someName = 'some name';
        $someColumn = new Column($someName);
        $someColumns = [$someColumn];
        $isWritable = true;
        $testedObject = new ColumnCollection($someColumns, $isWritable);

        $result = $testedObject->getColumn($someName);

        self::assertEquals($someColumn, $result);
    }
}
