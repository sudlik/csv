<?php

namespace Csv\Writer;

use Csv\Document;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Table;
use Csv\Value\CsvConfig;
use Csv\Value\DirectoryPath;
use Csv\Value\FileConfig;
use Csv\Value\Filename;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

class DocumentWriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function writeDocument()
    {
        $writerAdapterFactory = $this->getMock('Csv\Factory\WriterAdapterFactory');

        $writerAdapterFactory
            ->method('create')
            ->willReturn($this->getMock('Csv\Adapter\WriterAdapter'));

        $documentWriter = new DocumentWriter($writerAdapterFactory);
        $dirPath = 'example';

        vfsStream::setup($dirPath);

        $document = new Document(
            new CsvConfig(
                Delimiter::get(Delimiter::COMMA),
                Enclosure::get(Enclosure::DOUBLE_QUOTES),
                new VisibleNames(true)
            ),
            new FileConfig(
                Charset::get(CHARSET::UTF8),
                new DirectoryPath(vfsStream::url($dirPath)),
                new Filename('test.csv'),
                new WithBom(true)
            ),
            new Table
        );

        $this->assertNull($documentWriter->write($document));
    }
}
