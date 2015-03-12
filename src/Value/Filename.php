<?php

namespace Csv\Value;

use Csv\Exception\InvalidFilenameException;
use ValueObjects\ValueObjectInterface;

final class Filename implements ValueObjectInterface
{
    /** @var string */
    private $filename;

    public function __construct($filename)
    {
        if (preg_match('#[[:^print:]/.]#', $filename)) {
            throw new InvalidFilenameException($filename);
        }

        $this->filename = $filename;
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->filename === $object->getValue();
    }

    public function __toString()
    {
        return self::class . '(' . $this->filename . ')';
    }

    public function getValue()
    {
        return $this->filename;
    }
}
