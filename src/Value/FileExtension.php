<?php

namespace Csv\Value;

use Csv\Exception\InvalidFileExtensionException;
use ValueObjects\ValueObjectInterface;

final class FileExtension implements ValueObjectInterface
{
    /** @var string */
    private $fileExtension;

    public function __construct($fileExtension)
    {
        if (preg_match('#[[:^print:]/.\s]#', $fileExtension)) {
            throw new InvalidFileExtensionException($fileExtension);
        }

        $this->fileExtension = $fileExtension;
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->fileExtension === $object->getValue();
    }

    public function __toString()
    {
        return self::class . '(' . $this->getValue() . ')';
    }

    public function getValue()
    {
        return $this->fileExtension;
    }
}
