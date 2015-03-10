<?php

namespace Csv\Tests\Performance;

use Csv\Writer\SplWriter;
use Csv\Collection\ColumnCollection;
use Csv\Factory\SplFileObjectFactory;
use Csv\Factory\SplWriterFactory;
use Csv\Tests\PerformanceTestCase;

class SplWriterTest extends PerformanceTestCase
{
    protected function getWriter()
    {
        return (new SplWriterFactory(new SplFileObjectFactory))->createNative(
            $this->getWriterConfig(),
            $this->getFilePath(),
            $this->getColumns()
        );
    }

    protected function getSource()
    {
        return SplWriter::class;
    }

    /**
     * @return string
     */
    public function getColumnCollectionClassName()
    {
        return ColumnCollection::class;
    }
}
