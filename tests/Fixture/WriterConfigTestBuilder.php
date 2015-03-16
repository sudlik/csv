<?php

namespace Csv\Tests\Fixture;

use Csv\Value\Charset;
use Csv\Value\ContentConfig;
use Csv\Value\CsvConfig;
use Csv\Value\Delimiter;
use Csv\Value\EnclosureCharacter;
use Csv\Value\EnclosureConfig;
use Csv\Value\EnclosureStrategy;
use Csv\Value\EndOfLine;
use Csv\Value\Escape;
use Csv\Value\WriteMode;
use Csv\Value\WriterConfig;

class WriterConfigTestBuilder
{
    private $charset;
    private $delimiter;
    private $enclosureCharacter;
    private $enclosureStrategy;
    private $endOfLine;
    private $escape;
    private $writeMode;

    public function __construct()
    {
        $this->charset = Charset::UTF_8_WITH_BOM();
        $this->delimiter = Delimiter::COMMA();
        $this->enclosureCharacter = EnclosureCharacter::QUOTATION_MARK();
        $this->enclosureStrategy = EnclosureStrategy::STANDARD();
        $this->endOfLine = EndOfLine::LINE_FEED();
        $this->escape = Escape::BACKSLASH();
        $this->writeMode = WriteMode::OVERWRITE_OR_CREATE();
    }

    /**
     * @param Charset $charset
     * @return $this
     */
    public function setCharset(Charset $charset)
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * @param Delimiter $delimiter
     * @return $this
     */
    public function setDelimiter(Delimiter $delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * @param EnclosureCharacter $enclosureCharacter
     * @return $this
     */
    public function setEnclosureCharacter(EnclosureCharacter $enclosureCharacter)
    {
        $this->enclosureCharacter = $enclosureCharacter;

        return $this;
    }

    /**
     * @param EnclosureStrategy $enclosureStrategy
     * @return $this
     */
    public function setEnclosureStrategy(EnclosureStrategy $enclosureStrategy)
    {
        $this->enclosureStrategy = $enclosureStrategy;

        return $this;
    }

    /**
     * @param EndOfLine $endOfLine
     * @return $this
     */
    public function setEndOfLine(EndOfLine $endOfLine)
    {
        $this->endOfLine = $endOfLine;

        return $this;
    }

    /**
     * @param Escape $escape
     * @return $this
     */
    public function setEscape(Escape $escape)
    {
        $this->escape = $escape;

        return $this;
    }

    /**
     * @param WriteMode $writeMode
     * @return $this
     */
    public function setWriteMode(WriteMode $writeMode)
    {
        $this->writeMode = $writeMode;

        return $this;
    }

    public function create()
    {
        return new WriterConfig(
            new CsvConfig(
                $this->delimiter,
                new EnclosureConfig($this->enclosureCharacter, $this->enclosureStrategy),
                $this->escape
            ),
            new ContentConfig($this->charset, $this->endOfLine, $this->writeMode)
        );
    }
}
