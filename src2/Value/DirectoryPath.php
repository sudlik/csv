<?php

namespace Csv\ValueObject;

use Csv\Exception\InvalidFilenameArgumentException;
use Csv\ValueObject;

class DirectoryPathValueObject implements ValueObject
{
    private $value;
    
    public function __construct($directoryPath)
    {
        if (is_dir($directoryPath)) {
            $this->value = $directoryPath;
        } else {
            throw new InvalidDirectoryPathArgumentException('Directory does not exists');
        }
    }

    public function getValue()
    {
        return $value;
    }
}