<?php

namespace Seb\IpController;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Seb\IpController\IpGeoController;

/**
 * IpGeoController test class.
 */
class IpGeoControllerTest extends TestCase
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
        $IpGeoController = new IpGeoController();
        $IpGeoController->setDI($this->di);

        $res = $IpGeoController->indexActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testIndexActionPost()
    {
        $IpGeoController = new IpGeoController();
        $IpGeoController->setDI($this->di);

        $res = $IpGeoController->indexActionPost();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
