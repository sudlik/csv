<?php

namespace Csv\Factory;

use Csv\Value\Filename;

/**
 * Class FilenameFactory
 * @package Csv
 */
class FilenameFactory
{
    /**
     * @param string $filename
     * @return Filename
     */
    public function create($filename = 'document.csv')
    {
        return new Filename($filename);
    }
}
