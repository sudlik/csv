<?php

namespace Csv\Factory;

use Csv\Adapter\SplWriterAdapter;
use Csv\Value\OpenFileMode;
use Csv\Value\DirectoryPath;
use Csv\Value\Filename;

/**
 * Class SplWriterAdapterFactory
 * @package Csv
 */
class SplWriterAdapterFactory implements WriterAdapterFactory
{
    /**
     * @var SplFileObjectFactory
     */
    private $splFileObjectFactory;

    public function __construct()
    {
        $this->splFileObjectFactory = new SplFileObjectFactory;
    }

    /**
     * @param DirectoryPath $directoryPath
     * @param Filename $filename
     * @return SplWriterAdapter
     */
    public function createWithWrite(DirectoryPath $directoryPath, Filename $filename)
    {
        return $this->create($directoryPath, $filename, OpenFileMode::get(OpenFileMode::WRITE));
    }

    /**
     * @param DirectoryPath $directoryPath
     * @param Filename $filename
     * @return SplWriterAdapter
     */
    public function createWithWritePlus(DirectoryPath $directoryPath, Filename $filename)
    {
        return $this->create($directoryPath, $filename, OpenFileMode::get(OpenFileMode::WRITE_PLUS));
    }

    /**
     * @param DirectoryPath $directoryPath
     * @param Filename $filename
     * @param OpenFileMode $mode
     * @return SplWriterAdapter
     */
    private function create(DirectoryPath $directoryPath, Filename $filename, OpenFileMode $mode)
    {
        return new SplWriterAdapter($this->splFileObjectFactory->create($directoryPath, $filename, $mode));
    }
}
