<?php

namespace Csv\Value;

use Csv\Exception\InvalidByteOrderMarkException;
use ValueObjects\ValueObjectInterface;

final class ContentConfig implements ValueObjectInterface
{
    private $charset;
    private $endOfLine;
    private $writeMode;

    /** @var bool */
    private $byteOrderMark;

    public function __construct(Charset $charset, EndOfLine $endOfLine, WriteMode $writeMode, $byteOrderMark)
    {
        $this->charset = $charset;
        $this->endOfLine = $endOfLine;
        $this->writeMode = $writeMode;
        $this->byteOrderMark = $byteOrderMark;

        if (!is_bool(filter_var($byteOrderMark, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE))) {
            throw new InvalidByteOrderMarkException;
        }
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function getEndOfLine()
    {
        return $this->endOfLine;
    }

    public function getWriteMode()
    {
        return $this->writeMode;
    }

    public function hasByteOrderMark()
    {
        return $this->byteOrderMark;
    }

    public function __toString()
    {
        return self::class . '('
        . $this->charset . ', '
        . $this->endOfLine . ', '
        . $this->writeMode . ', '
        . $this->byteOrderMark . ')';
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $object instanceof self
            and $this->charset->sameValueAs($object->getCharset())
            and $this->endOfLine->sameValueAs($object->getEndOfLine())
            and $this->writeMode->sameValueAs($object->getWriteMode())
            and $this->byteOrderMark === $object->hasByteOrderMark();
    }
}
