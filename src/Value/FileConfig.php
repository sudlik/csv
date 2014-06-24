<?php

namespace Csv\Value;

use Csv\Enum\Charset;
use Csv\Value;
use Csv\Value\DirectoryPath;
use Csv\Value\Filename;
use ValueObjects\ValueObjectInterface;

class FileConfig extends Value
{
    /**
     * @var Csv\Enum\Charset
     */
    private $charset;

    /**
     * @var Csv\Value\DirectoryPath
     */
    private $directoryPath;

    /**
     * @var Csv\Value\Filename
     */
    private $filename;

    /**
     * @var Csv\Value\WithBom
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
     * @param  ValueObjectInterface $object
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

    public function getCharset()
    {
        return $this->charset;
    }

    public function getDirectoryPath()
    {
        return $this->directoryPath;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getWithBom()
    {
        return $this->withBom;
    }

    public function getPath()
    {
        return $this->getDirectoryPath() . DIRECTORY_SEPARATOR . $this->getFilename();
    }
}