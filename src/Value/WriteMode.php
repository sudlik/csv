<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static WriteMode OVERWRITE()
 * @method static WriteMode OVERWRITE_OR_CREATE()
 * @method static WriteMode APPEND()
 * @method static WriteMode APPEND_OR_CREATE()
 * @method static WriteMode PREPEND()
 * @method static WriteMode PREPEND_OR_CREATE()
 */
final class WriteMode extends Enum
{
    const OVERWRITE = 'w';
    const OVERWRITE_OR_CREATE = 'w+';
    const APPEND = 'a';
    const APPEND_OR_CREATE = 'a+';
    const PREPEND = 'x';
    const PREPEND_OR_CREATE = 'x+';

    public function __toString()
    {
        return self::class . '::' . $this->getName() . '()';
    }
}
