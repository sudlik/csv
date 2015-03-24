<?php

namespace Csv\Value;

use ValueObjects\ValueObjectInterface;

final class FilePath implements ValueObjectInterface
{
    private $directoryPath;
    private $filename;
    private $fileExtension;

    public function __construct(DirectoryPath $directoryPath, Filename $filename, FileExtension $fileExtension)
    {
        $this->directoryPath = $directoryPath;
        $this->filename = $filename;
        $this->fileExtension = $fileExtension;
    }

    public function __toString()
    {
        return self::class . '(' . $this->directoryPath . ', ' . $this->filename . ', ' . $this->fileExtension . ')';
    }

    public static function fromNative()
    {
        return new self(
            new DirectoryPath(func_get_arg(0)),
            new Filename(func_get_arg(1)),
            new FileExtension(func_get_arg(2))
        );
    }

    public static function fromPath($path)
    {
        $pathInfo = pathinfo($path);

        return new FilePath(
            new DirectoryPath($pathInfo['dirname']),
            new Filename(rtrim($pathInfo['basename'], '.' . $pathInfo['extension'])),
            new FileExtension($pathInfo['extension'])
        );
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $object instanceof self
            and $this->directoryPath->sameValueAs($object->getDirectoryPath())
            and $this->filename->sameValueAs($object->getFilename())
            and $this->fileExtension->sameValueAs($object->getFileExtension());
    }

    public function getDirectoryPath()
    {
        return $this->directoryPath;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    public function getBasename()
    {
        return $this->filename->getValue(). '.' . $this->fileExtension->getValue();
    }

    public function toNative()
    {
        return $this->directoryPath->getValue()
        . '/' . $this->filename->getValue()
        . '.' . $this->fileExtension->getValue();
    }
}
