<?php

namespace Csv\Enum;

use ValueObjects\Enum\Enum;

class OpenFileMode extends Enum
{
    const WRITE = 'w';
    const WRITE_PLUS = 'w+';
}
