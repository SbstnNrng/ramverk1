<?php

namespace Seb\Ip;

use PHPUnit\Framework\TestCase;
use Seb\IpModel\IpGeoCheck;

/**
 * IpGeoCheck test class.
 */
class IpGeoCheckTest extends TestCase
{

    public function testIpCheck()
    {
        $IpGeoCheck = new IpGeoCheck();
        $this->assertInstanceOf("\Seb\IpModel\IpGeoCheck", $IpGeoCheck);

        $locationTest = $IpGeoCheck->checkLocation("8.8.8.8");
        $cordsTest = $IpGeoCheck->checkCords("8.8.8.8");
        $this->assertIsString($locationTest);
        $this->assertIsString($cordsTest);

        $locationTest = $IpGeoCheck->checkLocation("4");
        $cordsTest = $IpGeoCheck->checkCords("4");
        $this->assertEquals($locationTest, "Plats: Hittades ej");
        $this->assertEquals($cordsTest, "Koordinater: Hittades ej");

        $userTest = $IpGeoCheck->checkUser();
        $this->assertIsString($userTest);
    }
}
