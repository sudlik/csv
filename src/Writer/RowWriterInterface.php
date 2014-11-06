<?php
namespace Csv\Writer;

use Csv\Builder\DocumentBuilderInterface;

/**
 * Class RowWriter
 * @package Csv
 */
interface RowWriterInterface
{
    /**
     * @param DocumentBuilderInterface $documentBuilder
     */
    public function write(DocumentBuilderInterface $documentBuilder);
}
