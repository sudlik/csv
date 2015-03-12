<?php

namespace Csv\Tests\Unit\Factory;

use Csv\Tests\Double\Collection\NamedWritableColumnCollectionMock;
use Csv\Writer\ExtendedSplWriter;
use Csv\Writer\SplWriter;
use Csv\Factory\SplWriterFactory;
use Csv\Tests\Double\Factory\SplFileObjectFromPathAndModeFactoryMock;
use Csv\Tests\Fixture\FilePathMother;
use Csv\Tests\Fixture\WriterConfigMother;
use PHPUnit_Framework_TestCase;

class SplWriterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_SplWriter()
    {
        $splFileObjectFactory = new SplWriterFactory(new SplFileObjectFromPathAndModeFactoryMock);

        $valuesValidator = $splFileObjectFactory->createNative(
            WriterConfigMother::createDefault(),
            FilePathMother::createDefault(),
            new NamedWritableColumnCollectionMock
        );

        self::assertInstanceOf(SplWriter::class, $valuesValidator);
    }

    /**
     * @test
     */
    public function it_should_return_SplNonValidCsvWriter()
    {
        $splFileObjectFactory = new SplWriterFactory(new SplFileObjectFromPathAndModeFactoryMock);

        $valuesValidator = $splFileObjectFactory->createExtended(
            WriterConfigMother::createDefault(),
            FilePathMother::createDefault(),
            new NamedWritableColumnCollectionMock
        );

        self::assertInstanceOf(ExtendedSplWriter::class, $valuesValidator);
    }
}
