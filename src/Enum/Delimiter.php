<?php

namespace Csv\Enum;

use ValueObjects\Enum\Enum;

/**
 * Class Delimiter
 * @package Csv
 * @method static Delimiter COLON()
 * @method static Delimiter COMMA()
 * @method static Delimiter PIPE()
 * @method static Delimiter POINT()
 * @method static Delimiter SEMICOLON()
 */
class Delimiter extends Enum
{
    const COLON = ':';
    const COMMA = ',';
    const PIPE = '|';
    const POINT = '.';
    const SEMICOLON = ';';
}
