<?php

namespace Csv\ValueObject;

use Csv\Enum\CharsetEnum;
use Csv\Enum\DelimiterEnum;
use Csv\Enum\EnclosurerEnum;
use Csv\Enum\EscapeEnum;
use Csv\Exception\InvalidFilenameArgumentException;
use Csv\ValueObject;
use Csv\ValueObject\DirectoryPathValueObject;
use Csv\ValueObject\FilenameValueObject;

class DocumentConfigValueObject implements ValueObject
{
    /**
     * @var Csv\Enum\CharsetEnum
     */
    private $charsetEnum;

    /**
     * @var Csv\Enum\EscapeEnum
     */
    private $escapeEnum;

    /**
     * @var Csv\Enum\EnclosurerEnum
     */
    private $enclosureEnum;

    /**
     * @var Csv\Enum\DelimiterEnum
     */
    private $delimiterEnum;

    /**
     * @var Csv\ValueObject\DirectoryPathValueObject
     */
    private $directoryPathValueObject;

    /**
     * @var Csv\ValueObject\FilenameValueObject
     */
    private $filenameValueObject;

    /**
     * @param DirectoryPathValueObject $directoryPathValueObject required
     * @param FilenameValueObject $filenameValueObject required
     * @param DelimiterEnum $delimiterEnum required
     * @param EnclosurerEnum $enclosureEnum required
     * @param EnclosurerEnum $enclosureEnum required
     * @param CharsetEnum $charsetEnum required
     */
    public function __construct(
        DirectoryPathValueObject $directoryPathValueObject,
        FilenameValueObject $filenameValueObject,
        DelimiterEnum $delimiterEnum,
        EnclosurerEnum $enclosureEnum,
        EscapeEnum $escapeEnum,
        CharsetEnum $charsetEnum
    ) {
        $this->directoryPathValueObject = $directoryPathValueObject;
        $this->filenameValueObject = $filenameValueObject;
        $this->delimiterEnum = $delimiterEnum;
        $this->enclosureEnum = $enclosureEnum;
        $this->escapeEnum = $escapeEnum;
        $this->charsetEnum = $charsetEnum;
    }

    public function getDirectoryPath()
    {
        return $this->directoryPathValueObject;
    }

    public function getFilename()
    {
        return $this->filenameValueObject;
    }

    public function getDelimiter()
    {
        return $this->delimiterEnum;
    }

    public function getEnclosure()
    {
        return $this->enclosureEnum;
    }

    public function getEscape()
    {
        return $this->escapeEnum;
    }

    public function getCharset()
    {
        return $this->charsetEnum;
    }
}