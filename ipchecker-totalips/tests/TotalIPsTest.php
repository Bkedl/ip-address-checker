<?php

use PHPUnit\Framework\TestCase;

require_once 'src/functions.inc.php';

class GetTotalIPsTest extends TestCase
{

    public function testEmptyIPs()
    {
        $items = "";
        $expected = 1; 

        $this->assertEquals(
            $expected, 
            getTotalIPs
            ($items)
        );
    }

    public function testSingleIP()
    {
        $items = "0.0.0.0";
        $expected = 1;

        $this->assertEquals(
            $expected, 
            getTotalIPs
            ($items)
        );
    }

    public function testTotalIPs()
    {
        $items = "0.1.0.1, 12.34.56.abc, 1000.1000.1000.abcd";
        $expected = 3;

        $this->assertEquals(
            $expected, 
            getTotalIPs
            ($items)
        );
    }

    public function testIPsNoSpace()
    {
        $items = "0.1.0.1,12.34.56.abc,1000.1000.1000.abcd";
        $expected = 3;

        $this->assertEquals(
            $expected, 
            getTotalIPs
            ($items)
        );
    }

    public function testIPWithSomeSpace()
    {
        $items = "0.1.0.1, 12.34.56.abc , 1000.1000.1000.abcd";
        $expected = 3;

        $this->assertEquals(
            $expected, 
            getTotalIPs
            ($items)
        );
    }

    public function testOtherVariations()
    {
        $items = "....,::::::::,abcde";
        $expected = 3;

        $this->assertEquals(
            $expected, 
            getTotalIPs
            ($items)
        );
    }
}