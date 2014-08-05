<?php

namespace Csv\Value;

use Csv\Enum\Charset;
use ValueObjects\ValueObjectInterface;

/**
 * Class FileConfig
 * @package Csv
 */
final class FileConfig extends Value
{
    /**
     * @var Charset
     */
    private $charset;

    /**
     * @var DirectoryPath
     */
    private $directoryPath;

    /**
     * @var Filename
     */
    private $filename;

    /**
     * @var WithBom
     */
    private $withBom;

    /**
     * @param Charset $charset required
     * @param DirectoryPath $directoryPath required
     * @param Filename $filename required
     */
    public function __construct(Charset $charset, DirectoryPath $directoryPath, Filename $filename, WithBom $withBom)
    {
        $this->charset = $charset;
        $this->directoryPath = $directoryPath;
        $this->filename = $filename;
        $this->withBom = $withBom;
    }

    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @return ValueObjectInterface
     */
    public static function fromNative()
    {
        return new self(func_get_arg(0), func_get_arg(1), func_get_arg(2), func_get_arg(3));
    }

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  self $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $this->getCharset() === $object->getCharset()
            and $this->getDirectoryPath() === $object->getDirectoryPath()
            and $this->getFilename() === $object->getFilename()
            and $this->getWithBom() === $object->getWithBom();
    }

    /**
     * @return Charset
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @return DirectoryPath
     */
    public function getDirectoryPath()
    {
        return $this->directoryPath;
    }

    /**
     * @return Filename
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return WithBom
     */
    public function getWithBom()
    {
        return $this->withBom;
    }
}
