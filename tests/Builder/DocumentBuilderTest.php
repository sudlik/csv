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
}