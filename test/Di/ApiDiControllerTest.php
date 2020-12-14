<?php

namespace Seb\DI;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Seb\DIController\ApiDIController;

/**
 * ApiDIController test class.
 */
class ApiDIControllerTest extends TestCase
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
        $ApiDIController = new ApiDIController();
        $ApiDIController->setDI($this->di);

        $res = $ApiDIController->indexActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testJsonDIActionPost()
    {
        $ApiDIController = new ApiDIController();
        $ApiDIController->setDI($this->di);

        $request = $this->di->get("request");
        $request->setPost("ipPost", "8.8.8.8");
        $res = $ApiDIController->jsonDIActionPost();
        $this->assertIsArray($res);
        $request->setPost("ipPost", null);

        $request->setPost("ipPost", "hej");
        $res = $ApiDIController->jsonDIActionPost();
        $this->assertIsArray($res);
        $request->setPost("ipPost", null);
    }

    public function testJsonDIpActionGet()
    {
        $ApiDIController = new ApiDIController();
        $ApiDIController->setDI($this->di);

        $request = $this->di->get("request");
        $request->setGet("ip", "8.8.8.8");
        $res = $ApiDIController->jsonDIActionGet();
        $this->assertIsArray($res);
        $request->setGet("ip", null);

        $request = $this->di->get("request");
        $request->setGet("ip", "hej");
        $res = $ApiDIController->jsonDIActionGet();
        $this->assertIsArray($res);
        $request->setGet("ip", null);

        $this->assertIsArray($res);
    }
}
