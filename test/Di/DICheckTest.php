<?php

namespace Seb\DI;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * IpCheck test class.
 */
class DICheckTest extends TestCase
{
    protected $di;

    protected function setUp()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->di = $di;
    }

    public function testDiCheck()
    {
        $diCheck = $this->di->get("weather");
        $this->assertInstanceOf("\Seb\DIModel\DICheck", $diCheck);

        $ipTest = $diCheck->checkCords("8.8.8.8");
        $this->assertIsArray($ipTest);

        $coTest = $diCheck->validateCords(45, 45);
        $this->assertIsBool($coTest);
        $coTest = $diCheck->validateCords(45, 7000);
        $this->assertEquals($coTest, false);
        $coTest = $diCheck->validateCords(45, null);
        $this->assertEquals($coTest, false);

        $coTest = $diCheck->getHistWeatherUrls(45, 45);
        $this->assertIsArray($coTest);

        $urls = $diCheck->getForecastWeatherUrl(45, 45);
        $this->assertIsArray($urls);

        $coTest = $diCheck->curlMulti($urls);
        $this->assertIsArray($coTest);

        $map = $diCheck->map(45, 45);
        $this->assertIsString($map);
    }
}
