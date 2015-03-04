<?php

namespace Csv\Value;

use ValueObjects\ValueObjectInterface;

final class ContentConfig implements ValueObjectInterface
{
    private $charset;
    private $endOfLine;
    private $writeMode;

    public function __construct(Charset $charset, EndOfLine $endOfLine, WriteMode $writeMode)
    {
        $this->charset = $charset;
        $this->endOfLine = $endOfLine;
        $this->writeMode = $writeMode;
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

    public function __toString()
    {
        return self::class . '('
        . $this->charset . ', '
        . $this->endOfLine . ', '
        . $this->writeMode . ')';
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $object instanceof self
            and $this->charset->sameValueAs($object->getCharset())
            and $this->endOfLine->sameValueAs($object->getEndOfLine())
            and $this->writeMode->sameValueAs($object->getWriteMode());
    }

    public static function fromNative()
    {
        return new self(
            Charset::fromNative(func_get_arg(0)),
            EndOfLine::fromNative(func_get_arg(1)),
            WriteMode::fromNative(func_get_arg(2)),
            func_get_arg(3)
        );
    }
}
