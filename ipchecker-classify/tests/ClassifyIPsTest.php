<?php
use PHPUnit\Framework\TestCase;

class ClassifyIPsTest extends TestCase
{

    public function testClassifyipv6()
    {
        $ips = "0000:abcd:1111:2222:333abc:44:55:6, ::1, 1111::222:33:4:5a, 1234:5678:9abc:def::, ::abcd, :";
        $expected = [
            "0000:abcd:1111:2222:333abc:44:55:6" => "IPv6",
            "::1" => "IPv6",
            "1111::222:33:4:5a" => "IPv6",
            "1234:5678:9abc:def::" => "IPv6",
            "::abcd" => "IPv6",
            ":" => "IPv6"
        ];

        $this->assertEquals(
            $expected, 
            classifyIPs
            ($ips)
        );
    }

    public function testClassifyipv4()
    {
        $ips = "000.111.222.333, 0.0.0.0, ..., 12345abc.abc.123.abcd";
        $expected = [
            "000.111.222.333" => "IPv4",
            "0.0.0.0" => "IPv4",
            "..." => "IPv4",
            "12345abc.abc.123.abcd" => "IPv4"
        ];

        $this->assertEquals(
            $expected, 
            classifyIPs
            ($ips)
        );
    }

    public function testClassifyInvalid()
    {
        $ips = "1.2, 1.2.3, 1.2.3.4.5, , 1:2:3:4:5:6:7:8:9";
        $expected = [
            "1.2" => "Invalid",
            "1.2.3" => "Invalid",
            "1.2.3.4.5" => "Invalid",
            "" => "Invalid", 
            "1:2:3:4:5:6:7:8:9" => "Invalid"
        ];

        $this->assertEquals(
            $expected,    
            classifyIPs
            ($ips)
        );
    }
}