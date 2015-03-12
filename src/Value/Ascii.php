<?php

namespace Csv\Value;

use Csv\Exception\InvalidAsciiException;
use Csv\Exception\InvalidAsciiIntegerException;
use ValueObjects\ValueObjectInterface;

final class Ascii implements ValueObjectInterface
{
    /** @var string */
    private $ascii;

    public static function null()
    {
        return new self(chr(0));
    }

    public static function fromInteger($ascii)
    {
        $options = [
            'options' => ['min_range' => 0, 'max_range' => 255],
            'flags' => [FILTER_FLAG_ALLOW_OCTAL | FILTER_FLAG_ALLOW_HEX],
        ];

        $filteredAscii = filter_var($ascii, FILTER_VALIDATE_INT, $options);
        if (!is_int($filteredAscii)) {
            throw new InvalidAsciiIntegerException($ascii);
        }

        return new self(chr($filteredAscii));
    }

    public function __construct($ascii)
    {
        if ($ascii !== chr(ord($ascii))) {
            throw new InvalidAsciiException($ascii);
        }

        $this->ascii = $ascii;
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return $object instanceof self and $this->ascii === $object->getValue();
    }

    public function __toString()
    {
        return self::class . '(' . ord($this->ascii) . ')';
    }

    public function getValue()
    {
        return $this->ascii;
    }
}
