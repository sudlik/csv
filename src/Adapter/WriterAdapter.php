<?php

namespace Csv\Adapter;

interface WriterAdapter
{
    /**
     * @param array $values
     * @return self
     */
    public function write(array $values);
}
