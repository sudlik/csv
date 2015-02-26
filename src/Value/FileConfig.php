<?php

namespace Csv\Value;

use Csv\Exception\InvalidWithBomValueException;
use ValueObjects\ValueObjectInterface;

final class FileConfig implements ValueObjectInterface
{
    /** @var Charset */
    private $charset;

    /** @var DirectoryPath */
    private $directoryPath;

    /** @var Filename */
    private $filename;

    private $withBom;

    public function __construct(Charset $charset, DirectoryPath $directoryPath, Filename $filename, $withBom)
    {
        $this->charset = $charset;
        $this->directoryPath = $directoryPath;
        $this->filename = $filename;

        if (is_bool($withBom)) {
            $this->withBom = $withBom;
        } else {
            throw new InvalidWithBomValueException;
        }
    }

    public static function fromNative()
    {
        return new self(
            Charset::fromNative(func_get_arg(0)),
            new DirectoryPath(func_get_arg(1)),
            new Filename(func_get_arg(2)),
            func_get_arg(3)
        );
    }

    public function sameValueAs(ValueObjectInterface $object)
    {
        return
            $object instanceof self
            and $this->charset->is($object->getCharset())
            and $this->directoryPath->sameValueAs($object->getDirectoryPath())
            and $this->filename->sameValueAs($object->getFilename())
            and $this->withBom === $object->getWithBom();
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

    public function __toString()
    {
        return 'CsvConfig('
        . $this->charset . ', '
        . $this->directoryPath . ', '
        . $this->filename . ','
        . $this->withBom . ')';
    }
}
