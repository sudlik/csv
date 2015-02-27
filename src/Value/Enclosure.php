<?php

namespace Csv\Value;

use ValueObjects\ValueObjectInterface;

final class Enclosure implements ValueObjectInterface
{
    private $character;
    private $positions;

    public function __construct(EnclosureCharacter $enclosureChar, EnclosurePositions $enclosurePosition)
    {
        $this->character = $enclosureChar;
        $this->positions = $enclosurePosition;
    }

    public static function fromNative()
    {
        return new self(
            EnclosureCharacter::fromNative(func_get_arg(0)),
            EnclosurePositions::fromNative(func_get_arg(1))
        );
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $object instanceof self
            and $this->character->is($object->getCharacter())
            and $this->positions->is($object->getPositions());
    }

    public function __toString()
    {
        return self::class . '(' . $this->character . ', ' . $this->positions . ')';
    }

    public function getCharacter()
    {
        return $this->character;
    }

    public function getPositions()
    {
        return $this->positions;
    }
}
