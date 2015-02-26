<?php

namespace Csv\Adapter;

use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;
use SplFileObject;
use StdClass;

class SplWriterAdapterTest extends PHPUnit_Framework_TestCase
{
    /** @var SplWriterAdapter */
    private $object;

    private $path;

    protected function setUp()
    {
        $dirPath = 'example';

        vfsStream::setup($dirPath);

        $this->path = vfsStream::url($dirPath . DIRECTORY_SEPARATOR . 'test.csv');
        $this->object = new SplWriterAdapter(new SplFileObject($this->path, 'w+'));
    }

    /**
     * @test
     */
    public function createFile()
    {
        $this->assertFileExists($this->path);
    }

    /**
     * test
     * disabled
     */
    public function lockFileOnConstructObject()
    {
        $this->assertFalse((new SplFileObject($this->path, 'w'))->flock(LOCK_EX|LOCK_NB, $isLocked));
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
     * @param $expected
     * @param $string
     */
    public function writeString($expected, $string)
    {
        $this->object->writeString($string);

        $this->assertEquals($expected, file_get_contents($this->path));
    }

    public function notStrings()
    {
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
                [],
            ],
        ];
    }

    /**
     * @test
     * @dataProvider notStrings
     * @depends writeString
     * @expectedException \Csv\Exception\UnexpectedArgumentTypeException
     * @param $notString
     */
    public function writeStringException($notString)
    {
        $this->object->writeString($notString);
    }
}
