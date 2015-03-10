<?php

namespace Csv\Value;

use ValueObjects\ValueObjectInterface;

final class EnclosureConfig implements ValueObjectInterface
{
    private $character;
    private $strategy;

    public function __construct(EnclosureCharacter $character, EnclosureStrategy $strategy)
    {
        $this->character = $character;
        $this->strategy = $strategy;
    }

    public static function fromNative()
    {
        return new self(
            EnclosureCharacter::fromNative(func_get_arg(0)),
            EnclosureStrategy::fromNative(func_get_arg(1))
        );
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $object instanceof self
            and $this->character->is($object->getCharacter())
            and $this->strategy->sameValueAs($object->getStrategy());
    }

    public function __toString()
    {
        return self::class . '(' . $this->character . ', ' . $this->strategy . ')';
    }

    public function getCharacter()
    {
        return $this->character;
    }

    public function getStrategy()
    {
        return $this->strategy;
    }
}
