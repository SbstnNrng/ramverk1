<?php

namespace Seb\Ip;

use PHPUnit\Framework\TestCase;

/**
 * IpCheck test class.
 */
class IpCheckTest extends TestCase
{

    public function testIpCheck()
    {
        $IpCheck = new IpCheck();
        $this->assertInstanceOf("\Seb\Ip\IpCheck", $IpCheck);

        $ipTest = $IpCheck->checkIp("8.8.8.8");
        $domainStr = $IpCheck->checkDomain("8.8.8.8");
        
        $this->assertEquals($ipTest, "8.8.8.8 is a valid IPV4 address");
        $this->assertIsString($domainStr);

        $ipTest = $IpCheck->checkIp("123.4.56.789");
        $domainStr = $IpCheck->checkDomain("123.4.56.789");

        $this->assertEquals($ipTest, "123.4.56.789 is not a valid IP address");
        $this->assertIsString($domainStr);

        $ipTest = $IpCheck->checkIp("0000:0000:0000:0000:0000:0000:0000:0001");
        $domainStr = $IpCheck->checkDomain("0000:0000:0000:0000:0000:0000:0000:0001");

        $this->assertEquals($ipTest, "0000:0000:0000:0000:0000:0000:0000:0001 is a valid IPV6 address");
        $this->assertIsString($domainStr);

        $domainStr = $IpCheck->checkDomain("1.2.3.4");
        $this->assertEquals($domainStr, "1.2.3.4 has no domain");
    }
}
