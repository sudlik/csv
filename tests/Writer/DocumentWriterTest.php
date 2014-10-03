<?php

namespace Csv\Writer;

use Csv\Collection\Row;
use Csv\Collection\RowCollection;
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
     * @slowThreshold 100
     */
    public function writeDocument()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $writerAdapterFactory */
        $writerAdapterFactory = $this->getMock('Csv\Factory\WriterAdapterFactory');

        $writerAdapterFactory
            ->method('createWithWrite')
            ->willReturn($this->getMock('Csv\Adapter\WriterAdapter'));

        $documentWriter = new DocumentWriter($writerAdapterFactory);
        $dirPath = 'example';

        vfsStream::setup($dirPath);

        $document = $this->getMockBuilder('Csv\Document')
            ->disableOriginalConstructor()
            ->getMock();

        $document
            ->method('getCsvConfig')
            ->willReturn(
                new CsvConfig(
                    Delimiter::get(Delimiter::COMMA),
                    Enclosure::get(Enclosure::DOUBLE_QUOTES),
                    new VisibleNames(true)
                )
            );

        $document
            ->method('getFileConfig')
            ->willReturn(
                new FileConfig(
                    Charset::get(Charset::UTF8),
                    new DirectoryPath(vfsStream::url($dirPath)),
                    new Filename('test.csv'),
                    new WithBom(true)
                )
            );

        $table = $this->getMockBuilder('Csv\Table\Table')->getMock();

        $table
            ->method('getNames')
            ->willReturn(new Row);

        $table
            ->method('getRows')
            ->willReturn((new RowCollection)->add(new Row));

        $document
            ->method('getTable')
            ->willReturn($table);

        $documentWriter->write($document);
    }
}
