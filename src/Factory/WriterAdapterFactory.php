<?php

namespace Csv\Factory;

use Csv\Value\DirectoryPath;
use Csv\Value\Filename;

/**
 * Interface WriterAdapterFactory
 * @package Csv
 */
interface WriterAdapterFactory
{
    /**
     * @param DirectoryPath $directoryPath
     * @param Filename $filename
     * @return \Csv\Adapter\WriterAdapter
     */
    public function createWithWrite(DirectoryPath $directoryPath, Filename $filename);

    /**
     * @param DirectoryPath $directoryPath
     * @param Filename $filename
     * @return \Csv\Adapter\WriterAdapter
     */
    public function createWithWritePlus(DirectoryPath $directoryPath, Filename $filename);
}
