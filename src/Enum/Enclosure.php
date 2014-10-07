<?php

namespace Csv\Enum;

use ValueObjects\Enum\Enum;

/**
 * Class Enclosure
 * @package Csv
 * @method static Enclosure SINGLE_QUOTES()
 * @method static Enclosure DOUBLE_QUOTES()
 */
class Enclosure extends Enum
{
    const SINGLE_QUOTES = "'";
    const DOUBLE_QUOTES = '"';
}
