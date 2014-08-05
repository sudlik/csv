<?php

namespace Csv\Enum;

use ValueObjects\Enum\Enum;

/**
 * Class OpenFileMode
 * @package Csv
 */
class OpenFileMode extends Enum
{
    const WRITE = 'w';
    const WRITE_PLUS = 'w+';
}
