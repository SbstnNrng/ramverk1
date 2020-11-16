<?php

namespace Seb\Ip;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * IpController test class.
 */
class IpControllerTest extends TestCase
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
        $IpController = new IpController();
        $IpController->setDI($this->di);

        $res = $IpController->indexActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testIndexActionPost()
    {
        $IpController = new IpController();
        $IpController->setDI($this->di);

        $res = $IpController->indexActionPost();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
