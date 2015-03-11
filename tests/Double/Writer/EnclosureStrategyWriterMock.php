<?php

namespace Csv\Tests\Double\Writer;

use Csv\Writer\EnclosureStrategyWriter;

class EnclosureStrategyWriterMock implements EnclosureStrategyWriter
{
    public function write(array $values)
    {
        return $this;
    }
}
