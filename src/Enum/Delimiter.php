<?php

namespace Csv\Enum;

use ValueObjects\Enum\Enum;

/**
 * Class Delimiter
 * @package Csv
 */
class Delimiter extends Enum
{
    const COLON = ':';
    const COMMA = ',';
    const PIPE = '|';
    const POINT = '.';
    const SEMICOLON = ';';
}
