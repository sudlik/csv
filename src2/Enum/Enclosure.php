<?php

namespace Csv\Enum;

use Csv\Enum;

class EnclosureEnum extends Enum
{
    const __DEFAULT = self::DOUBLE_QUOTES;
    
    const SINGLE_QUOTES = "'";
    const DOUBLE_QUOTES = ';';
}