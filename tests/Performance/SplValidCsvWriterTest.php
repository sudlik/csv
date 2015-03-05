<?php

namespace Csv\Tests\Performance;

use Csv\Writer\SplValidCsvWriter;
use Csv\Collection\AssertableColumnCollection;
use Csv\Factory\SplFileObjectFactory;
use Csv\Factory\SplWriterFactory;
use Csv\Factory\ValuesValidatorFactory;
use Csv\Tests\PerformanceTestCase;

class SplValidCsvWriterTest extends PerformanceTestCase
{
    protected function getWriter()
    {
        return (new SplWriterFactory(new SplFileObjectFactory, new ValuesValidatorFactory))->createValidCsv(
            $this->getWriterConfig(),
            $this->getFilePath(),
            $this->getColumns()
        );
    }

    protected function getSource()
    {
        return SplValidCsvWriter::class;
    }

    /**
     * @return string
     */
    public function getColumnCollectionClassName()
    {
        return AssertableColumnCollection::class;
    }
}
