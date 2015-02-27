<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static Escape BACKSLASH()
 * @method static Escape FORWARD_SLASH()
 */
final class Escape extends Enum
{
    const BACKSLASH = '\\';
    const FORWARD_SLASH = '/';

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
