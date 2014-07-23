<?php

namespace Csv\Factory;

use Csv\Adapter\SplWriterAdapter;
use Csv\Enum\OpenFileMode;
use Csv\Value\DirectoryPath;
use Csv\Value\Filename;

class SplWriterAdapterFactory implements WriterAdapterFactory
{
    private $splFileObjectFactory;

    public function __construct()
    {
        $this->splFileObjectFactory = new SplFileObjectFactory;
    }

    public function createWithWrite(DirectoryPath $directoryPath, Filename $filename)
    {
        return $this->create($directoryPath, $filename, OpenFileMode::get(OpenFileMode::WRITE));
    }

    public function createWithWritePlus(DirectoryPath $directoryPath, Filename $filename)
    {
        return $this->create($directoryPath, $filename, OpenFileMode::get(OpenFileMode::WRITE_PLUS));
    }

    private function create(DirectoryPath $directoryPath, Filename $filename, OpenFileMode $mode)
    {
        return new SplWriterAdapter($this->splFileObjectFactory->create($directoryPath, $filename, $mode));
    }
}
