<?php

namespace TestCase;

use Dbr\Ezpl\Printer;

class PrinterTest extends \PHPUnit_Framework_TestCase
{
    protected $printer;

    public function setUp()
    {
        $connector = $this->prophesize('\Dbr\Ezpl\Driver\ConnectorInterface');
        $builder = $this->prophesize('\Dbr\Ezpl\BuilderInterface');

        $this->printer = new Printer($connector->reveal(), $builder->reveal());
    }

    public function tearDown()
    {
        $this->printer = null;
    }

    public function testPrinterMethod()
    {
        $this->assertInstanceOf('\Dbr\Ezpl\Driver\ConnectorInterface', $this->printer->printer());
    }

    public function testBuilderMethod()
    {
        $this->assertInstanceOf('\Dbr\Ezpl\BuilderInterface', $this->printer->builder());
    }
}
