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
use StdClass;

class SplWriterAdapterTest extends PHPUnit_Framework_TestCase
{
    private $object;
    private $path;

    protected function setUp()
    {
        $dirPath = 'example';

        vfsStream::setup($dirPath);

        $this->path = vfsStream::url($dirPath . DIRECTORY_SEPARATOR . 'test.csv');
        $this->object = new SplWriterAdapter(new SplFileObject($this->path, 'w'));
    }

    /**
     * @test
     */
    public function createFile()
    {
        $this->assertFileExists($this->path);
    }

    public function strings()
    {
        $value = 'string';

        return [
            [
                $value,
                $value,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider strings
     * @depends createFile
     */
    public function writeString($expected, $string)
    {
        $this->object->writeString($string);

        $this->assertEquals($expected, file_get_contents($this->path));
    }

    public function notStrings()
    {
        $value = 'string';

        return [
            [
                0.1,
            ],
            [
                1,
            ],
            [
                true,
            ],
            [
                new StdClass,
            ],
            [
                array(),
            ],
        ];
    }

    /**
     * @test
     * @dataProvider notStrings
     * @depends writeString
     * @expectedException Csv\Exception\UnexpectedArgumentTypeException
     */
    public function writeStringException($notString)
    {
        $this->object->writeString($notString);
    }

    public function rows()
    {
        $value = 'string';

        return [
            [
                $value . PHP_EOL,
                (new Row)->add(new Cell($value)),
            ],
        ];
    }

    /**
     * @test
     * @dataProvider rows
     * @depends createFile
     */
    public function writeRow($expected, $row)
    {
        $this->object->writeRow(Delimiter::get(Delimiter::COMMA), Enclosure::get(Enclosure::DOUBLE_QUOTES), $row);

        $this->assertEquals($expected, file_get_contents($this->path));
    }

    public function delimiters()
    {
        $values = ['first-cell', 'second-cell'];
        $row = (new Row)->add(new Cell($values[0]))->add(new Cell($values[1]));

        return [
            [
                implode($values, Delimiter::COLON) . PHP_EOL,
                Delimiter::get(Delimiter::COLON),
                $row,
            ],
            [
                implode($values, Delimiter::COMMA) . PHP_EOL,
                Delimiter::get(Delimiter::COMMA),
                $row,
            ],
            [
                implode($values, Delimiter::PIPE) . PHP_EOL,
                Delimiter::get(Delimiter::PIPE),
                $row,
            ],
            [
                implode($values, Delimiter::POINT) . PHP_EOL,
                Delimiter::get(Delimiter::POINT),
                $row,
            ],
            [
                implode($values, Delimiter::SEMICOLON) . PHP_EOL,
                Delimiter::get(Delimiter::SEMICOLON),
                $row,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider delimiters
     * @depends writeRow
     */
    public function setDelimiter($expected, $delimiter, $row)
    {
        $this->object->writeRow($delimiter, Enclosure::get(Enclosure::DOUBLE_QUOTES), $row);

        $this->assertEquals($expected, file_get_contents($this->path));
    }

    public function stringsWithWhiteSpace()
    {
        $value = 'string with whitespaces';

        return [
            [
                Enclosure::DOUBLE_QUOTES . $value . Enclosure::DOUBLE_QUOTES . PHP_EOL,
                (new Row)->add(new Cell($value)),
            ],
        ];
    }

    /**
     * @test
     * @dataProvider stringsWithWhiteSpace
     * @depends writeRow
     */
    public function enclosureStringWithWhiteSpace($expected, $row)
    {
        $this->object->writeRow(Delimiter::get(Delimiter::COMMA), Enclosure::get(Enclosure::DOUBLE_QUOTES), $row);

        $this->assertEquals($expected, file_get_contents($this->path));
    }

    public function enclosures()
    {
        $value = 'string with whitespaces';
        $row = (new Row)->add(new Cell($value));

        return [
            [
                Enclosure::SINGLE_QUOTES . $value . Enclosure::SINGLE_QUOTES . PHP_EOL,
                Enclosure::get(Enclosure::SINGLE_QUOTES),
                $row,
            ],
            [
                Enclosure::DOUBLE_QUOTES . $value . Enclosure::DOUBLE_QUOTES . PHP_EOL,
                Enclosure::get(Enclosure::DOUBLE_QUOTES),
                $row,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider enclosures
     * @depends enclosureStringWithWhiteSpace
     */
    public function setEnclosure($expected, $enclosure, $row)
    {
        $this->object->writeRow(Delimiter::get(Delimiter::COMMA), $enclosure, $row);

        $this->assertEquals($expected, file_get_contents($this->path));
    }
}
