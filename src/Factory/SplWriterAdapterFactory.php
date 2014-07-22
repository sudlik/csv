<?php

namespace Csv\Factory;

use Csv\Adapter\SplWriterAdapter;
use Csv\Value\DirectoryPath;
use Csv\Value\Filename;

class SplWriterAdapterFactory implements WriterAdapterFactory
{
    private $splFileObjectFactory;

    public function __construct()
    {
        $this->splFileObjectFactory = new SplFileObjectFactory;
    }

    public function create(DirectoryPath $directoryPath, Filename $filename)
    {
        return new SplWriterAdapter(
            $this->splFileObjectFactory->create(
                $directoryPath->getValue()
                . DIRECTORY_SEPARATOR
                . $filename->getPath()
            )
        );
    }
}
