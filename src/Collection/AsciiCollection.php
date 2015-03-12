<?php

namespace Csv\Collection;

use ArrayIterator;
use Csv\Exception\InvalidAsciiException;
use Csv\Value\Ascii;
use IteratorAggregate;

final class AsciiCollection implements IteratorAggregate
{
    private $native;
    private $iterator;

    public static function bom()
    {
        return new self([Ascii::fromInteger(0xef), Ascii::fromInteger(0xbb), Ascii::fromInteger(0xbf)]);
    }

    public function __construct(array $characters)
    {
        $this->iterator = new ArrayIterator($characters);

        foreach ($characters as $character) {
            if ($character instanceof Ascii) {
                $this->native .= $character->getValue();
            } else {
                throw new InvalidAsciiException($characters);
            }
        }
    }

    public function sameValueAs(AsciiCollection $object)
    {
        return $this->native === $object->toNative();
    }

    public function __toString()
    {
        return self::class . '(' . implode(', ', $this->iterator->getArrayCopy()) . ')';
    }

    public function getCharacters()
    {
        return $this->iterator->getArrayCopy();
    }

    public function toNative()
    {
        return $this->native;
    }

    public function getIterator()
    {
        return $this->iterator;
    }
}
