<?php

namespace Csv\Value;

use Csv\Exception\InvalidAsciiCharacterException;
use ValueObjects\ValueObjectInterface;

final class AsciiCharacter implements ValueObjectInterface
{
    private $value;

    public static function null()
    {
        return new self(0);
    }

    public function __construct($value)
    {
        $options = [
            'options' => ['min_range' => 0, 'max_range' => 255],
            'flags' => [FILTER_FLAG_ALLOW_OCTAL | FILTER_FLAG_ALLOW_HEX],
        ];

        if (!is_int(filter_var($value, FILTER_VALIDATE_INT, $options))) {
            throw new InvalidAsciiCharacterException($value);
        }

        $this->value = chr($value);
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->value === $object->getValue();
    }

    public function __toString()
    {
        return self::class . '(' . ord($this->value) . ')';
    }

    public function getValue()
    {
        return $this->value;
    }
}
