<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static EnclosureStrategy ALL()
 * @method static EnclosureStrategy STANDARD()
 * @method static EnclosureStrategy STANDARD_WITH_FRACTIONS()
 * @method static EnclosureStrategy NONE()
 */
final class EnclosureStrategy extends Enum
{
    const ALL = 'all';
    const STANDARD = 'standard';
    const STANDARD_WITH_FRACTIONS = 'standard_with_fractions';
    const NONE = 'none';

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
