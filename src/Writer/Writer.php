<?php

namespace Csv\Writer;

use Csv\Adapter\WriterAdapter;
use Csv\Enum\Charset;
use Csv\Factory\WriterAdapterFactory;
use Csv\Value\WithBom;

abstract class Writer
{
    const FIRST_ROW_POSITION = 0;

    /** @var string */
    protected $bom;

    /** @var Charset */
    protected $charset;

    /** @var WriterAdapter */
    protected $writerAdapter;

    /** @var WriterAdapterFactory */
    protected $writerAdapterFactory;

    /** @var Charset */
    protected $utf8;

    /** @var WithBom */
    protected $withBom;

    /**
     * @param WriterAdapterFactory $writerAdapterFactory
     */
    public function __construct(WriterAdapterFactory $writerAdapterFactory)
    {
        $this->bom = chr(0xef) . chr(0xbb) . chr(0xbf);
        $this->utf8 = Charset::get(Charset::UTF8);
        $this->writerAdapterFactory = $writerAdapterFactory;
    }
}
