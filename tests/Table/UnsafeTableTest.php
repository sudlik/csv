<?php

namespace Csv\Table;

use PHPUnit_Framework_TestCase;

/**
 * Class UnsafeTableTest
 * @package Csv
 */
class UnsafeTableTest extends PHPUnit_Framework_TestCase
{
    /** @var UnsafeTable */
    private $object;

    protected function setUp()
    {
        $this->object = new UnsafeTable;
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
