<?php

namespace Seb\Ip;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Seb\IpController\IpGeoApiController;

/**
 * IpApiController test class.
 */
class IpGeoApiControllerTest extends TestCase
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


    public function testIndexActionGet()
    {
        $IpController = new IpGeoApiController();
        $IpController->setDI($this->di);

        $res = $IpController->indexActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    public function testJsonIpGeoActionPost()
    {
        $IpController = new IpGeoApiController();
        $IpController->setDI($this->di);

        $res = $IpController->jsonIpGeoActionPost();

        $this->assertIsArray($res);
    }

    public function testJsonIpGeoActionGet()
    {
        $IpController = new IpGeoApiController();
        $IpController->setDI($this->di);

        $res = $IpController->jsonIpGeoActionGet();

        $this->assertIsArray($res);
    }
}
