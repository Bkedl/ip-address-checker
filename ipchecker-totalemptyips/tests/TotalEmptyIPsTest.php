<?php

use PHPUnit\Framework\TestCase;

require_once 'src/functions.inc.php';

class GetTotalEmptyIPsTest extends TestCase
{
    public function testNoEmptyIPs()
    {
        $items = "123.456.789.000,abc.def.ghi.jkl";
        $expected = 0;
        
        $this->assertEquals(
            $expected, 
            getTotalEmptyIPs($items)
        );
    }

    public function testAllEmptyIPs()
    {
        $items = ",,,";
        $expected = 4;

        $this->assertEquals(
            $expected, 
            getTotalEmptyIPs($items)
        );
    }

    public function testSomeEmptyIPs()
    {
        $items = "123.456.789.000,,abc.def.ghi.jkl,";
        $expected = 2;

        $this->assertEquals(
            $expected, 
            getTotalEmptyIPs($items)
        );
    }

    public function testSides()
    {
        $items = ",";
        $expected = 2; 

        $this->assertEquals(
            $expected, 
            getTotalEmptyIPs($items)
        );
    }

    public function testVariationsEmpty()
    {
        $items = "123abc,,,xyz789,,";
        $expected = 4;

        $this->assertEquals(
            $expected, 
            getTotalEmptyIPs($items)
        );
    }

    public function testJustOne()
    {
        $items = ",";
        $expected = 2; 

        $this->assertEquals(
            $expected, 
            getTotalEmptyIPs($items)
        );
    }
}
