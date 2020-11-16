<?php

namespace Seb\Ip;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * IpApiController test class.
 */
class IpApiControllerTest extends TestCase
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
        $IpController = new IpApiController();
        $IpController->setDI($this->di);

        $res = $IpController->indexActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    public function testJsonIpActionPost()
    {
        $IpController = new IpApiController();
        $IpController->setDI($this->di);

        $res = $IpController->jsonIpActionPost();

        $this->assertIsArray($res);
    }

    public function testJsonIpActionGet()
    {
        $IpController = new IpApiController();
        $IpController->setDI($this->di);

        $res = $IpController->jsonIpActionGet();

        $this->assertIsArray($res);
    }
}
