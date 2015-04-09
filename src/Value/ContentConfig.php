<?php

namespace Csv\Value;

final class ContentConfig
{
    private $charset;
    private $endOfLine;
    private $writeMode;

    public static function standard()
    {
        return new self(Charset::UTF_8_WITH_BOM(), EndOfLine::fromNative(PHP_EOL), WriteMode::OVERWRITE_OR_CREATE());
    }

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
}
