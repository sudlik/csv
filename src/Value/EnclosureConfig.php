<?php

namespace Csv\Value;

final class EnclosureConfig
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

    public function getCharacter()
    {
        return $this->character;
    }

    public function getStrategy()
    {
        return $this->strategy;
    }
}
