<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static Charset ISO_8859_2()
 * @method static Charset UTF_8_WITHOUT_BOM()
 * @method static Charset UTF_8_WITH_BOM()
 * @method static Charset WINDOWS_1250()
 */
final class Charset extends Enum
{
    const ISO_8859_2 = 'ISO-8859-2';
    const UTF_8_WITHOUT_BOM = 'UTF-8 without BOM';
    const UTF_8_WITH_BOM = 'UTF-8 with BOM';
    const WINDOWS_1250 = 'Windows-1250';

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
