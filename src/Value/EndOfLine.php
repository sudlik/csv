<?php

namespace Csv\Value;

use ValueObjects\Enum\Enum;

/**
 * @method static EndOfLine LINE_FEED()
 * @method static EndOfLine CARRIAGE_RETURN()
 * @method static EndOfLine CARRIAGE_RETURN_LINE_FEED()
 * @method static EndOfLine LINE_FEED_CARRIAGE_RETURN()
 * @method static EndOfLine NONE()
 */
final class EndOfLine extends Enum
{
    const LINE_FEED = "\n";
    const CARRIAGE_RETURN = "\r";
    const CARRIAGE_RETURN_LINE_FEED = "\r\n";
    const LINE_FEED_CARRIAGE_RETURN = "\n\r";
    const NONE = '';

    public function __toString()
    {
        return self::class . '::' . $this->getVisible() . '()';
    }

    private function getVisible()
    {
        switch ($this->getValue()) {
            case self::LINE_FEED:
                return '\n';
            case self::CARRIAGE_RETURN:
                return '\r';
            case self::CARRIAGE_RETURN_LINE_FEED:
                return '\r\n';
            case self::LINE_FEED_CARRIAGE_RETURN:
                return '\n\r';
        }

        return '';
    }
}
