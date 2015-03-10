<?php

namespace Csv\Writer;

interface EnclosureStrategyWriter
{
    /**
     * @param array $values
     * @return self
     */
    public function write(array $values);
}
