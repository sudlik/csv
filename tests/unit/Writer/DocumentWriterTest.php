<?php

namespace Csv\Writer;

use Csv\Builder\DocumentBuilder;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

class DocumentWriterTest extends PHPUnit_Framework_TestCase
{
    private $documentBuilder;

    protected function setUp()
    {
        $dirPath = 'example';
        $this->dirPath = vfsStream::url($dirPath);
        $this->fileName = 'test.csv';

        vfsStream::setup($dirPath);

        $this->path = vfsStream::url($dirPath . DIRECTORY_SEPARATOR . $this->fileName);
        $this->documentBuilder = new DocumentBuilder($this->dirPath, $this->fileName);
    }

    /**
     * @test
     */
    public function writeDocumentToCsvFile()
    {
        (new DocumentWriter($this->documentBuilder->getDocument()))->write();

        $this->assertFileExists($this->path);
    }

    /**
     * @test
     * @depends writeDocumentToCsvFile
     */
    public function writeBom()
    {
        (new DocumentWriter($this->documentBuilder->withBom(true)->name()->getDocument()))->write();

        $this->assertEquals(
            chr(0xef) . chr(0xbb) . chr(0xbf) . PHP_EOL,
            file_get_contents($this->path),
            'BOM and EOL expected'
        );
    }

    /**
     * @test
     * @depends writeDocumentToCsvFile
     */
    public function enclosureStringWithWhiteSpace()
    {
        $document = $this->documentBuilder->withBom(false)->name('String with white spaces')->getDocument();
        
        (new DocumentWriter($document))->write();

        $this->assertEquals('"String with white spaces"' . PHP_EOL, file_get_contents($this->path));
    }
}