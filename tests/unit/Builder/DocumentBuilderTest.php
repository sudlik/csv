<?php

namespace Csv\Builder;

use Csv\Collection\Row;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

class DocumentBuilderTest extends PHPUnit_Framework_TestCase
{
    private $object;

    protected function setUp()
    {
        $dirPath = 'example';
        $this->dirPath = vfsStream::url($dirPath);
        $this->fileName = 'test.csv';

        vfsStream::setup($dirPath);

        $this->path = vfsStream::url($dirPath . DIRECTORY_SEPARATOR . $this->fileName);
        $this->object = new DocumentBuilder($this->dirPath, $this->fileName);
    }

    /**
     * @test
     */
    public function getDocumentInstance()
    {
        $this->assertInstanceOf('Csv\Document', $this->object->getDocument());
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function getFileConfig()
    {
        $this->assertInstanceOf('Csv\Value\FileConfig', $this->object->getDocument()->getFileConfig());
    }

    /**
     * @test
     * @depends getFileConfig
     */
    public function getFileDirectory()
    {
        $this->assertEquals(
            $this->dirPath,
            $this->object
                ->getDocument()
                ->getFileConfig()
                ->getDirectoryPath()
                ->getValue()
        );
    }

    /**
     * @test
     * @depends getFileConfig
     */
    public function getFilename()
    {
        $this->assertEquals($this->fileName, $this->object->getDocument()->getFileConfig()->getFilename()->getValue());
    }

    /**
     * @test
     * @depends getFileConfig
     */
    public function getFilePath()
    {
        $this->assertEquals($this->path, $this->object->getDocument()->getFileConfig()->getPath());
    }

    /**
     * @test
     * @depends getFileConfig
     */
    public function getFileCharset()
    {
        $this->assertNotNull($this->object->getDocument()->getFileConfig()->getCharset()->getValue());
    }

    /**
     * @test
     * @depends getFileCharset
     */
    public function defaultCharset()
    {
        $this->assertEquals(Charset::UTF8, $this->object->getDocument()->getFileConfig()->getCharset()->getValue());
    }

    /**
     * @test
     * @depends getFileConfig
     */
    public function setFileCharset()
    {
        $this->assertEquals(
            Charset::UTF8,
            $this->object
                ->charset(Charset::UTF8)
                ->getDocument()
                ->getFileConfig()
                ->getCharset()
                ->getValue()
        );
    }

    /**
     * @test
     * @depends getFileConfig
     */
    public function getWithBom()
    {
        $this->assertNotNull($this->object->getDocument()->getFileConfig()->getWithBom());
    }

    /**
     * @test
     * @depends getWithBom
     */
    public function defaultWithBom()
    {
        $this->assertEquals(true, $this->object->getDocument()->getFileConfig()->getWithBom()->getValue());
    }

    /**
     * @test
     * @depends getWithBom
     */
    public function setWithBom()
    {
        $this->assertEquals(
            false,
            $this->object
                ->withBom(false)
                ->getDocument()
                ->getFileConfig()
                ->getWithBom()
                ->getValue()
        );
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function getCsvConfig()
    {
        $this->assertInstanceOf('Csv\Value\CsvConfig', $this->object->getDocument()->getCsvConfig());
    }

    /**
     * @test
     * @depends getCsvConfig
     */
    public function defaultNamesVisible()
    {
        $this->assertEquals(true, $this->object->getDocument()->getCsvConfig()->getVisibleNames()->getValue());
    }

    /**
     * @test
     * @depends getCsvConfig
     */
    public function setVisibleNames()
    {
        $this->assertEquals(
            false,
            $this->object
                ->visibleNames(false)
                ->getDocument()
                ->getCsvConfig()
                ->getVisibleNames()
                ->getValue()
        );
    }

    /**
     * @test
     * @depends getCsvConfig
     */
    public function setCsvDelimiter()
    {
        $this->assertEquals(
            Delimiter::SEMICOLON,
            $this->object
                ->delimiter(';')
                ->getDocument()
                ->getCsvConfig()
                ->getDelimiter()
                ->getValue()
        );
    }

    /**
     * @test
     * @depends getCsvConfig
     */
    public function setCsvEnclosure()
    {
        $this->assertEquals(
            Enclosure::DOUBLE_QUOTES,
            $this->object
                ->enclosure('"')
                ->getDocument()
                ->getCsvConfig()
                ->getEnclosure()
                ->getValue()
        );
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function addEmptyName()
    {
        $this->assertEquals('', $this->object->name()->getDocument()->getNames()->first()->getValue());
    }

    /**
     * @test
     * @depends addEmptyName
     */
    public function addName()
    {
        $this->assertEquals('Index', $this->object->name('Index')->getDocument()->getNames()->first()->getValue());
    }

    /**
     * @test
     * @depends addName
     */
    public function addMultipleNames()
    {
        $row = $this->object
            ->names(['Index', 'Name'])
            ->getDocument()
            ->getNames();

        $this->assertEquals('Index', $row->get(0)->getValue());
        $this->assertEquals('Name', $row->get(1)->getValue());
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function setNewName()
    {
        $row = $this->object
            ->name('Index', 1)
            ->getDocument()
            ->getNames();

        $this->assertEquals('', $row->get(0)->getValue());
        $this->assertEquals('Index', $row->get(1)->getValue());
    }

    /**
     * @test
     * @depends addName
     * @depends setNewName
     */
    public function overwriteName()
    {
        $documentBuilder = $this->object->name('Index');

        $this->assertEquals('Index', $documentBuilder->getDocument()->getNames()->first()->getValue());

        $documentBuilder->name('Name', 0);

        $this->assertEquals('Name', $documentBuilder->getDocument()->getNames()->first()->getValue());
    }

    /**
     * @test
     * @depends setNewName
     */
    public function setMultipleNames()
    {
        $row = $this->object
            ->names([['Index', 1]])
            ->getDocument()
            ->getNames();

        $this->assertEquals('', $row->get(0)->getValue());
        $this->assertEquals('Index', $row->get(1)->getValue());
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function addEmptyRow()
    {
        $this->assertEquals('', $this->object->row()->getDocument()->getData()->first()->first()->getValue());
    }

    /**
     * @test
     * @depends addEmptyRow
     */
    public function addRowWithCells()
    {
        $row = $this->object
            ->row(['A', 'B'])
            ->getDocument()
            ->getData()
            ->first();

        $this->assertEquals('A', $row->get(0)->getValue());
        $this->assertEquals('B', $row->get(1)->getValue());
    }

    /**
     * @test
     * @depends addRowWithCells
     */
    public function addMultipleRows()
    {
        $row = $this->object
            ->row(['A', 'B'])
            ->getDocument()
            ->getData()
            ->first();

        $this->assertEquals('A', $row->get(0)->getValue());
        $this->assertEquals('B', $row->get(1)->getValue());
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function setNewRow()
    {
        $rows = $this->object
            ->row(['Test'], 1)
            ->getDocument()
            ->getData();

        $this->assertEquals('', $rows->get(0)->first()->getValue());
        $this->assertEquals('Test', $rows->get(1)->first()->getValue());
    }

    /**
     * @test
     * @depends addEmptyRow
     * @depends setNewRow
     */
    public function overwriteRow()
    {
        $documentBuilder = $this->object->row(['A']);

        $this->assertEquals('A', $documentBuilder->getDocument()->getData()->get(0)->first()->getValue());

        $documentBuilder->row(['B'], 0);

        $this->assertEquals('B', $documentBuilder->getDocument()->getData()->get(0)->first()->getValue());
    }

    /**
     * @test
     * @depends addEmptyRow
     * @expectedException Csv\Exception\CollectionIsFrozenException
     */
    public function setFrozen()
    {
        $this->object->row()->getDocument()->getData()->add(new Row);
    }
}