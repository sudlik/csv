<?php

namespace Csv\Value;

final class EnclosureConfig
{
    private $character;
    private $strategy;

    public static function standard()
    {
        return new self(EnclosureCharacter::QUOTATION_MARK(), EnclosureStrategy::STANDARD());
    }

    public static function withCharacter(EnclosureCharacter $character)
    {
        return new self($character, EnclosureStrategy::STANDARD());
    }

    public function __construct(EnclosureCharacter $character, EnclosureStrategy $strategy)
    {
        $this->character = $character;
        $this->strategy = $strategy;
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
