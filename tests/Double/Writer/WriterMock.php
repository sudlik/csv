<?php

namespace Csv\Tests\Double\Writer;

use Csv\Writer\Writer;

class WriterMock implements Writer
{
    public function write(array $values)
    {
        return $this;
    }
}
