<?php

namespace Csv;

use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Value\CsvConfig;
use Csv\Value\DirectoryPath;
use Csv\Value\FileConfig;
use Csv\Value\Filename;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;
use PHPUnit_Framework_TestCase;
use org\bovigo\vfs\vfsStream;

class DocumentTest extends PHPUnit_Framework_TestCase
{
    private $csvConfig;
    private $fileConfig;

    /** @var Document */
    private $object;

    private $table;

    protected function setUp()
    {
        $this->table = $this->getMockBuilder('Csv\Table')->getMock();

        $this->csvConfig = new CsvConfig(
            Delimiter::get(Delimiter::COMMA),
            Enclosure::get(Enclosure::DOUBLE_QUOTES),
            new VisibleNames(true)
        );

        $dirPath = 'example';

        vfsStream::setup($dirPath);

        $this->fileConfig = new FileConfig(
            Charset::get(Charset::UTF8),
            new DirectoryPath(vfsStream::url($dirPath)),
            new Filename('test.csv'),
            new WithBom(true)
        );

        $this->object = new Document($this->csvConfig, $this->fileConfig, $this->table);
    }

    /**
     * @test
     */
    public function getCsvConfig()
    {
        $this->assertEquals($this->csvConfig, $this->object->getCsvConfig());
    }

    /**
     * @test
     */
    public function getFileConfig()
    {
        $this->assertEquals($this->fileConfig, $this->object->getFileConfig());
    }

    /**
     * @test
     */
    public function getTable()
    {
        $this->assertEquals($this->table, $this->object->getTable());
    }
}
