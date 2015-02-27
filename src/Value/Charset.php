<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static Charset UTF_7()
 * @method static Charset UTF_8()
 * @method static Charset UTF_16()
 * @method static Charset UTF_32()
 */
final class Charset extends Enum
{
    const UTF_7 = 'UTF-7';
    const UTF_8 = 'UTF-8';
    const UTF_16 = 'UTF-16';
    const UTF_32 = 'UTF-32';

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
