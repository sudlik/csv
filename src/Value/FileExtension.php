<?php

namespace Csv\Value;

use Csv\Exception\InvalidFileExtensionException;
use ValueObjects\ValueObjectInterface;

final class FileExtension implements ValueObjectInterface
{
    const NULL = '';

    /** @var string */
    private $fileExtension;

    public static function null()
    {
        return new self(self::NULL);
    }

    public static function standard()
    {
        return new self('csv');
    }

    public function __construct($fileExtension)
    {
        if (preg_match('#[[:^print:]/.\s]#', $fileExtension) and $fileExtension !== self::NULL) {
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
