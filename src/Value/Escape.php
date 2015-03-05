<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static Escape APOSTROPHE()
 * @method static Escape QUOTATION_MARK()
 * @method static Escape GRAVE_ACCENT()
 * @method static Escape BACKSLASH()
 * @method static Escape FORWARD_SLASH()
 * @method static Escape NONE()
 */
final class Escape extends Enum
{
    const APOSTROPHE = "'";
    const QUOTATION_MARK = '"';
    const GRAVE_ACCENT = '`';
    const BACKSLASH = '\\';
    const FORWARD_SLASH = '/';
    const NONE = '';

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
