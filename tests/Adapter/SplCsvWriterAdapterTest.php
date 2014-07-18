<?php

namespace Csv\Adapter;

use Csv\Collection\Row;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Exception\UnexpectedArgumentTypeException;
use Csv\Value\Cell;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;
use SplFileObject;

class SplCsvWriterAdapterTest extends PHPUnit_Framework_TestCase
{
    private $path;

    protected function setUp()
    {
        $dirPath = 'example';

        vfsStream::setup($dirPath);

        $this->path = vfsStream::url($dirPath . DIRECTORY_SEPARATOR . 'test.csv');
    }

    /**
     * @test
     */
    public function createFile()
    {
        (new SplCsvWriterAdapter(new SplFileObject($this->path, 'w'), Delimiter::get(','), Enclosure::get('"')))
            ->writeString('');

        $this->assertFileExists($this->path);
    }

    public function rows()
    {
        $data = 'string';

        return [
            [
                $data . PHP_EOL,
                (new Row)->add(new Cell($data)),
            ],
        ];
    }

    /**
     * @test
     * @dataProvider rows
     * @depends createFile
     */
    public function writeRow($expected, $data)
    {
        (new SplCsvWriterAdapter(new SplFileObject($this->path, 'w'), Delimiter::get(','), Enclosure::get('"')))
            ->writeRow($data);

        $this->assertEquals($expected, file_get_contents($this->path));
    }

    public function delimiters()
    {
        return [
            [

                Delimiter::get(':'),
            ],
            [
                Delimiter::get(','),
            ],
            [
                Delimiter::get('|'),
            ],
            [
                Delimiter::get('.'),
            ],
            [
                Delimiter::get(';'),
            ],
        ];
    }

    /**
     * test
     * @dataProvider delimiters
     * @depends writeRow
     */
    public function setDelimiter($expected, $delimiter, $data)
    {
        (new SplCsvWriterAdapter(new SplFileObject($this->path, 'w'), $delimiter, Enclosure::get('"')))
            ->writeRow('');

        $this->assertFileExists($this->path);
    }
}
