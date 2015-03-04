<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static EnclosurePositions ALWAYS()
 * @method static EnclosurePositions STANDARD()
 * @method static EnclosurePositions FRACTION()
 * @method static EnclosurePositions NONE()
 */
final class EnclosurePositions extends Enum
{
    const STANDARD = 'standard';
    const ALWAYS = 'always';
    const FRACTION = 'fraction';
    const NONE = 'none';

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
