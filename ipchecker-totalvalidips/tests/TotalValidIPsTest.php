<?php
use PHPUnit\Framework\TestCase;

class TotalValidIPsTest extends TestCase
{


    public function testValidipv4()
    {
        $ips = "000.111.222.333, 12345a.67890b.101010c.45abcde, ...0, ...";
        $expected = [
            "000.111.222.333" => "Valid",
            "12345a.67890b.101010c.45abcde" => "Valid",
            "...0" => "Valid",
            "..." => "Valid"
        ];


        $this->assertEquals(
            $expected, 
            validateIPs
            ($ips)
        );
    }

    public function testValidipv6()
    {
        $ips = "aa:bb, 1234:5678:abcd:efgh:ijkl:mnop:qrst:uvwx, ::::, 123:456:789:abc:def:ghi:jkl:mno, ::, ::abcd";
        $expected = [
            "aa:bb" => "Valid",
            "1234:5678:abcd:efgh:ijkl:mnop:qrst:uvwx" => "Valid", 
            "::::" => "Valid", 
            "123:456:789:abc:def:ghi:jkl:mno" => "Valid", 
            "::" => "Valid", 
            "::abcd" => "Valid" 
        ];


        $this->assertEquals(
            $expected, 
            validateIPs
            ($ips)
        );
    }

    public function testInvalidIPAddresses()
    {
        $ips = "1.2, 1.2.3, 1.2.3.4.5, , 1:2:3:4:5:6:7:8:9";
        $expected = [
            "1.2" => "Invalid", 
            "1.2.3" => "Invalid", 
            "1.2.3.4.5" => "Invalid", 
            "" => "Invalid", // although it will not be placed on the front end as it has nothing in it
            // it still is tested here to show backend is working with this   
            "1:2:3:4:5:6:7:8:9" => "Invalid", 
        ];


        $this->assertEquals(
            $expected, 
            validateIPs
            ($ips)
        );
    }

    
}