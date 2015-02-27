<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static EnclosureCharacter APOSTROPHE()
 * @method static EnclosureCharacter QUOTATION_MARK()
 * @method static EnclosureCharacter GRAVE_ACCENT()
 */
final class EnclosureCharacter extends Enum
{
    const APOSTROPHE = "'";
    const QUOTATION_MARK = '"';
    const GRAVE_ACCENT = '`';

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
