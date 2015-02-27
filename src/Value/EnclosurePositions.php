<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static EnclosurePositions ALWAYS()
 * @method static EnclosurePositions NECESSARY()
 * @method static EnclosurePositions FRACTION()
 */
final class EnclosurePositions extends Enum
{
    const ALWAYS = 'always';
    const NECESSARY = 'necessary';
    const FRACTION = 'fraction';

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
