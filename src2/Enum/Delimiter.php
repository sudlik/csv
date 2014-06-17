<?php

namespace Csv\Enum;

use Csv\Enum;

class DelimiterEnum extends Enum
{
    const __DEFAULT = self::SEMICOLON;
    
    const SEMICOLON = ';';
    const COLON = ':';
    const POINT = '.';
}