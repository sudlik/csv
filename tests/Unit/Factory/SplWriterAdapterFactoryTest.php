<?php

namespace Csv\Tests\Unit\Factory;

use Csv\Adapter\SplWriterAdapter;
use Csv\Factory\SplWriterAdapterFactory;
use Csv\Tests\Double\Collection\NamedWritableColumnCollectionMock;
use Csv\Tests\Double\Factory\SplFileObjectFromPathAndModeFactoryMock;
use Csv\Tests\Double\Factory\ValuesValidatorFromColumnsFactoryMock;
use Csv\Tests\Fixture\FilePathMother;
use Csv\Tests\Fixture\WriterConfigMother;
use PHPUnit_Framework_TestCase;

class SplWriterAdapterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_object_with_given_path()
    {
        $splFileObjectFactory = new SplWriterAdapterFactory(
            new SplFileObjectFromPathAndModeFactoryMock,
            new ValuesValidatorFromColumnsFactoryMock
        );

        $valuesValidator = $splFileObjectFactory->createFormConfigPathAndColumns(
            WriterConfigMother::createDefault(),
            FilePathMother::createDefault(),
            new NamedWritableColumnCollectionMock
        );

        $this->assertInstanceOf(SplWriterAdapter::class, $valuesValidator);
    }
}
