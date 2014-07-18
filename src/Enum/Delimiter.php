<?php

namespace Csv\Enum;

use ValueObjects\Enum\Enum;

class Delimiter extends Enum
{
    const COLON = ':';
    const COMMA = ',';
    const PIPE = '|';
    const POINT = '.';
    const SEMICOLON = ';';
}
