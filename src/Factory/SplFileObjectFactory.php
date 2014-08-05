<?php

namespace Csv\Factory;

use Csv\Enum\OpenFileMode;
use Csv\Value\DirectoryPath;
use Csv\Value\Filename;
use SplFileObject;

/**
 * Class SplFileObjectFactory
 * @package Csv
 */
class SplFileObjectFactory
{
    /**
     * @param DirectoryPath $directoryPath
     * @param Filename $filename
     * @param OpenFileMode $openFileMode
     * @return SplFileObject
     */
    public function create(DirectoryPath $directoryPath, Filename $filename, OpenFileMode $openFileMode = null)
    {
        if ($openFileMode) {
            $mode = $openFileMode->getValue();
        } else {
            $mode = OpenFileMode::WRITE;
        }

        return new SplFileObject($directoryPath->getValue() . DIRECTORY_SEPARATOR . $filename->getValue(), $mode);
    }
}
