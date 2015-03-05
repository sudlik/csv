<?php

namespace Csv\Tests\Unit\Factory;

use Csv\Tests\Double\Collection\AssertableColumnCollectionMock;
use Csv\Writer\SplNonValidCsvWriter;
use Csv\Writer\SplValidCsvWriter;
use Csv\Factory\SplWriterFactory;
use Csv\Tests\Double\Factory\SplFileObjectFromPathAndModeFactoryMock;
use Csv\Tests\Double\Factory\ValuesValidatorFromColumnsFactoryMock;
use Csv\Tests\Fixture\FilePathMother;
use Csv\Tests\Fixture\WriterConfigMother;
use PHPUnit_Framework_TestCase;

class SplWriterFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_SplValidCsvWriter()
    {
        $splFileObjectFactory = new SplWriterFactory(
            new SplFileObjectFromPathAndModeFactoryMock,
            new ValuesValidatorFromColumnsFactoryMock
        );

        $valuesValidator = $splFileObjectFactory->createValidCsv(
            WriterConfigMother::createDefault(),
            FilePathMother::createDefault(),
            new AssertableColumnCollectionMock
        );

        $this->assertInstanceOf(SplValidCsvWriter::class, $valuesValidator);
    }
    /**
     * @test
     */
    public function it_should_return_SplNonValidCsvWriter()
    {
        $splFileObjectFactory = new SplWriterFactory(
            new SplFileObjectFromPathAndModeFactoryMock,
            new ValuesValidatorFromColumnsFactoryMock
        );

        $valuesValidator = $splFileObjectFactory->createNonValidCsv(
            WriterConfigMother::createDefault(),
            FilePathMother::createDefault(),
            new AssertableColumnCollectionMock
        );

        $this->assertInstanceOf(SplNonValidCsvWriter::class, $valuesValidator);
    }
}
