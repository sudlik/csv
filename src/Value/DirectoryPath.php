<?php

namespace Csv\Value;

use Csv\Exception\DirectoryIsUnwritableException;
use Csv\Exception\InvalidDirectoryPathException;
use ValueObjects\ValueObjectInterface;

final class DirectoryPath implements ValueObjectInterface
{
    /** @var string */
    private $directoryPath;

    public function __construct($directoryPath)
    {
        if (!is_dir($directoryPath)) {
            throw new InvalidDirectoryPathException($directoryPath);
        }

        if (!is_writable($directoryPath)) {
            throw new DirectoryIsUnwritableException($directoryPath);
        }

        $this->directoryPath = $directoryPath;
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->directoryPath === $object->getValue();
    }

    public function __toString()
    {
        return self::class . '(' . $this->directoryPath . ')';
    }

    public function getValue()
    {
        return $this->directoryPath;
    }
}
