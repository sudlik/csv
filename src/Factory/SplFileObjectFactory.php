<?php

namespace Csv\Factory;

use Csv\Value\OpenFileMode;
use SplFileObject;

class SplFileObjectFactory
{
    public function create($filepath, $mode = OpenFileMode::WRITE)
    {
        return new SplFileObject($filepath, $mode);
    }
}
