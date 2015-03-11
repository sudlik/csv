<?php

namespace Csv\Value;

use Csv\Exception\InvalidAsciiCharacterException;
use ValueObjects\ValueObjectInterface;

final class AsciiString implements ValueObjectInterface
{
    private $characters;
    private $native;

    public static function bom()
    {
        return new self([new AsciiCharacter(0xef), new AsciiCharacter(0xbb), new AsciiCharacter(0xbf)]);
    }

    public function __construct(array $characters)
    {
        foreach ($characters as $character) {
            if ($character instanceof AsciiCharacter) {
                $this->native .= $character->getValue();
            } else {
                throw new InvalidAsciiCharacterException($characters);
            }
        }

        $this->characters = $characters;
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->native === $object->toNative();
    }

    public function __toString()
    {
        return self::class . '(' . implode(', ', $this->characters) . ')';
    }

    public function getCharacters()
    {
        return $this->characters;
    }

    public function toNative()
    {
        return $this->native;
    }
}
