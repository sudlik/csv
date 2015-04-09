<?php

namespace Csv\Value;

final class FilePath
{
    private $directoryPath;
    private $filename;
    private $fileExtension;

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

        return new self(
            new DirectoryPath($pathInfo['dirname']),
            new Filename(rtrim($pathInfo['basename'], '.' . $pathInfo['extension'])),
            new FileExtension($pathInfo['extension'])
        );
    }

    public static function withStandardExtension(DirectoryPath $directoryPath, Filename $filename)
    {
        return new self($directoryPath, $filename, FileExtension::standard());
    }

    public function __construct(DirectoryPath $directoryPath, Filename $filename, FileExtension $fileExtension)
    {
        $this->directoryPath = $directoryPath;
        $this->filename = $filename;
        $this->fileExtension = $fileExtension;
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
