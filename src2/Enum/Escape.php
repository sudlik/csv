<?php

namespace Csv\Enum;

use Csv\Enum;

class EscapeEnum extends Enum
{
    const __DEFAULT = self::BACKSLASH;
    
    const BACKSLASH = '\\';
}