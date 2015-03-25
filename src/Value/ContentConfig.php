<?php

namespace Csv\Value;

final class ContentConfig
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

    public static function fromNative()
    {
        return new self(
            Charset::fromNative(func_get_arg(0)),
            EndOfLine::fromNative(func_get_arg(1)),
            WriteMode::fromNative(func_get_arg(2))
        );
    }
}
