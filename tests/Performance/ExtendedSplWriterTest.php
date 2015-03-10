<?php

namespace Csv\Tests\Performance;

use Csv\Writer\ExtendedSplWriter;
use Csv\Collection\ColumnCollection;
use Csv\Factory\SplFileObjectFactory;
use Csv\Factory\SplWriterFactory;
use Csv\Tests\PerformanceTestCase;

class ExtendedSplWriterTest extends PerformanceTestCase
{
    protected function getWriter()
    {
        return (new SplWriterFactory(new SplFileObjectFactory))->createExtended(
            $this->getWriterConfig(),
            $this->getFilePath(),
            $this->getColumns()
        );
    }

    protected function getSource()
    {
        return ExtendedSplWriter::class;
    }

    /**
     * @return string
     */
    public function getColumnCollectionClassName()
    {
        return ColumnCollection::class;
    }
}
