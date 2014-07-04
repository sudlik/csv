<?php

namespace Csv\Factory;

use Csv\Value\Filename;

class FilenameFactory
{
    public function create($filename = 'document.csv')
    {
        return new Filename($filename);
    }
}
