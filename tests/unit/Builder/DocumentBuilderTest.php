<?php

namespace Csv\Builder;

use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;
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
                ->toNative()
        );
    }

    /**
     * @test
     * @depends getFileConfig
     */
    public function getFilename()
    {
        $this->assertEquals($this->fileName, $this->object->getDocument()->getFileConfig()->getFilename()->toNative());
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
            $this->object->charset(Charset::UTF8)->getDocument()->getFileConfig()->getCharset()->getValue()
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
        $this->assertEquals(new WithBom(true), $this->object->getDocument()->getFileConfig()->getWithBom());
    }

    /**
     * @test
     * @depends getWithBom
     */
    public function setWithBom()
    {
        $this->assertEquals(
            new WithBom(false),
            $this->object->withBom(false)->getDocument()->getFileConfig()->getWithBom()
        );
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function writeDocumentToCsvFile()
    {
        $this->object->getDocument()->write();

        $this->assertFileExists($this->path);
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
        $this->assertEquals(new VisibleNames(true), $this->object->getDocument()->getCsvConfig()->getVisibleNames());
    }

    /**
     * @test
     * @depends getCsvConfig
     */
    public function setVisibleNames()
    {
        $this->assertEquals(
            new VisibleNames(false),
            $this->object
                ->visibleNames(false)
                ->getDocument()
                ->getCsvConfig()
                ->getVisibleNames()
        );
    }

    /**
     * @test
     * @depends getCsvConfig
     */
    public function setCsvDelimiter()
    {
        $this->assertEquals(
            Delimiter::get(Delimiter::SEMICOLON),
            $this->object
                ->delimiter(';')
                ->getDocument()
                ->getCsvConfig()
                ->getDelimiter()
        );
    }

    /**
     * @test
     * @depends getCsvConfig
     */
    public function setCsvEnclosure()
    {
        $this->assertEquals(
            Enclosure::get(Enclosure::DOUBLE_QUOTES),
            $this->object
                ->enclosure('"')
                ->getDocument()
                ->getCsvConfig()
                ->getEnclosure()
        );
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function addEmptyNameToDocument()
    {
        $this->assertEquals('', (string)$this->object->name()->getDocument()->getNames()->first());
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function addName()
    {
        $this->assertEquals('Index', (string)$this->object->name('Index')->getDocument()->getNames()->first());
    }

    /**
     * @test
     * @depends getDocumentInstance
     */
    public function addMultipleNames()
    {
        $row = $this->object
            ->name(['Index', 'Name'])
            ->getDocument()
            ->getNames();

        $this->assertEquals('Index', (string)$row->get(0));
        $this->assertEquals('Name', (string)$row->get(1));
    }

    /**
     * @test
     * @depends setWithBom
     * @depends writeDocumentToCsvFile
     * @depends setCsvEnclosure
     */
    public function enclosureStringWithWhiteSpace()
    {
        $this->object
            ->withBom(false)
            ->name('String with white spaces')
            ->getDocument()
            ->write();

        $this->assertEquals('"String with white spaces"' . PHP_EOL, file_get_contents($this->path));
    }

    /**
     * @test
     * @depends writeDocumentToCsvFile
     */
    public function addEmptyRow()
    {
        $this->assertEquals('', (string)$this->object->row()->getDocument()->getRowCollection()->first()->first());
    }

    /**
     * @test
     * @depends setWithBom
     * @depends writeDocumentToCsvFile
     */
    public function addRowWithCell()
    {
        $this->assertEquals(
            'Test',
            (string)$this->object
                ->row(['Test'])
                ->getDocument()
                ->getRowCollection()
                ->first()
                ->first()
        );
    }

    /**
     * @test
     * @depends addName
     * @depends writeDocumentToCsvFile
     */
    public function addMultipleRows()
    {
        $row = $this->object->row(['A', 'B'])->getDocument()->getRowCollection()->first();

        $this->assertEquals('A', (string)$row->get(0));
        $this->assertEquals('B', (string)$row->get(1));
    }
}