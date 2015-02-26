<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * Class OpenFileMode
 * @package Csv
 * @method static OpenFileMode WRITE()
 * @method static OpenFileMode WRITE_PLUS()
 */
class OpenFileMode extends Enum
{
    const WRITE = 'w';
    const WRITE_PLUS = 'w+';
}
