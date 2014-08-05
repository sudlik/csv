<?php

namespace Csv;

use PHPUnit_Framework_TestCase;

/**
 * Class TableTest
 * @package Csv
 */
class TableTest extends PHPUnit_Framework_TestCase
{
    /** @var Table */
    private $object;

    protected function setUp()
    {
        $this->object = new Table;
    }

    /**
     * @test
     */
    public function getNames()
    {
        $this->assertInstanceOf('Csv\Collection\Row', $this->object->getNames());
    }

    /**
     * @test
     */
    public function getRows()
    {
        $this->assertInstanceOf('Csv\Collection\RowCollection', $this->object->getRows());
    }
}
