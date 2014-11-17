<?php

namespace Csv\Writer;

use Csv\Builder\DocumentBuilder;
use Csv\Collection\Row;
use Csv\Enum\Charset;
use Csv\Enum\Delimiter;
use Csv\Enum\Enclosure;
use Csv\Factory\WriterAdapterFactory;
use Csv\Table;
use Csv\Value\CsvConfig;
use Csv\Value\DirectoryPath;
use Csv\Value\FileConfig;
use Csv\Value\Filename;
use Csv\Value\VisibleNames;
use Csv\Value\WithBom;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

class RowWriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @slowThreshold 130
     */
    public function writeDocument()
    {
        $writerAdapterFactory = $this->getMock('Csv\Factory\WriterAdapterFactory');

        $writerAdapterFactory
            ->method('createWithWritePlus')
            ->willReturn($this->getMock('Csv\Adapter\WriterAdapter'));

        /** @var WriterAdapterFactory $writerAdapterFactory */
        $documentWriter = new RowWriter($writerAdapterFactory);
        $dirPath = 'example';

        vfsStream::setup($dirPath);

        $table = $this->getMockBuilder('Csv\Table\Table')->getMock();

        $table
            ->method('getNames')
            ->willReturn(new Row);

        $table
            ->method('getRows')
            ->willReturn(new Row);

        $documentBuilder = $this->getMockBuilder('Csv\Builder\DocumentBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $documentBuilder
            ->method('getTable')
            ->willReturn($table);

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
                    Charset::get(CHARSET::UTF8),
                    new DirectoryPath(vfsStream::url($dirPath)),
                    new Filename('test.csv'),
                    new WithBom(true)
                )
            );

        $document
            ->method('getTable')
            ->willReturn($table);

        $documentBuilder
            ->method('getDocument')
            ->willReturn($document);

        /** @var DocumentBuilder $documentBuilder */
        $documentWriter->write($documentBuilder);
    }
}
