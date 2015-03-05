<?php

namespace Csv\Tests\Performance;

use Csv\Writer\SplNonValidCsvWriter;
use Csv\Collection\ColumnCollection;
use Csv\Factory\SplFileObjectFactory;
use Csv\Factory\SplWriterFactory;
use Csv\Factory\ValuesValidatorFactory;
use Csv\Tests\PerformanceTestCase;

class SplNonValidCsvWriterTest extends PerformanceTestCase
{
    protected function getWriter()
    {
        return (new SplWriterFactory(new SplFileObjectFactory, new ValuesValidatorFactory))->createNonValidCsv(
            $this->getWriterConfig(),
            $this->getFilePath(),
            $this->getColumns()
        );
    }

    protected function getSource()
    {
        return SplNonValidCsvWriter::class;
    }

    /**
     * @return string
     */
    public function getColumnCollectionClassName()
    {
        return ColumnCollection::class;
    }
}
