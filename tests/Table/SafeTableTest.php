<?php

namespace Csv\Table;

use PHPUnit_Framework_TestCase;

/**
 * Class SafeTableTest
 * @package Csv
 */
class SafeTableTest extends PHPUnit_Framework_TestCase
{
    /** @var SafeTable */
    private $object;

    protected function setUp()
    {
        $this->object = new SafeTable;
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
