<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static Delimiter COLON()
 * @method static Delimiter COMMA()
 * @method static Delimiter PIPE()
 * @method static Delimiter POINT()
 * @method static Delimiter SEMICOLON()
 */
final class Delimiter extends Enum
{
    const COLON = ':';
    const COMMA = ',';
    const PIPE = '|';
    const POINT = '.';
    const SEMICOLON = ';';

    public function __toString()
    {
        return self::class . '::' . $this->getName() . '()';
    }
}
