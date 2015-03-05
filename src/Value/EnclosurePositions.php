<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static EnclosurePositions ALWAYS_FORCE()
 * @method static EnclosurePositions STANDARD()
 * @method static EnclosurePositions FORCE_ON_FRACTIONS()
 * @method static EnclosurePositions NONE()
 */
final class EnclosurePositions extends Enum
{
    const STANDARD = 'standard';
    const ALWAYS_FORCE = 'always';
    const FORCE_ON_FRACTIONS = 'fraction';
    const NONE = 'none';

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
