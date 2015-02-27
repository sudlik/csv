<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static EndOfLine EMPTY_STRING()
 * @method static EndOfLine LINE_FEED()
 * @method static EndOfLine CARRIAGE_RETURN()
 * @method static EndOfLine CARRIAGE_RETURN_LINE_FEED()
 * @method static EndOfLine LINE_FEED_CARRIAGE_RETURN()
 */
final class EndOfLine extends Enum
{
    const EMPTY_STRING = '';
    const LINE_FEED = "\n";
    const CARRIAGE_RETURN = "\r";
    const CARRIAGE_RETURN_LINE_FEED = "\r\n";
    const LINE_FEED_CARRIAGE_RETURN = "\n\r";

    public function __toString()
    {
        return self::class . '::' . $this->getValue() . '()';
    }
}
