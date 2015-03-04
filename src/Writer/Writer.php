<?php

namespace Csv\Writer;

interface Writer
{
    /**
     * @param array $values
     * @return self
     */
    public function write(array $values);
}
