<?php

namespace Seb\DI;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Seb\DIController\DIController;

/**
 * DIController test class.
 */
class DIControllerTest extends TestCase
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
        $DIController = new DIController();
        $DIController->setDI($this->di);

        $res = $DIController->indexActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testIndexActionPost()
    {
        $DIController = new DIController();
        $DIController->setDI($this->di);

        $request = $this->di->get("request");
        $request->setPost("ipCheck", "yes");
        $request->setPost("ipPost", "8.8.8.8");
        $res = $DIController->indexActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $request->setPost("ipCheck", null);
        $request->setPost("ipPost", null);

        $request->setPost("coCheck", "yes");
        $request->setPost("lonPost", 45);
        $request->setPost("latPost", 45);
        $res = $DIController->indexActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $request->setPost("coCheck", null);
        $request->setPost("lonPost", null);
        $request->setPost("latPost", null);

        $request->setPost("ipCheck", "yes");
        $request->setPost("ipPost", "hej");
        $res = $DIController->indexActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $request->setPost("ipCheck", null);
        $request->setPost("ipPost", null);

        $request->setPost("coCheck", "yes");
        $request->setPost("lonPost", 700);
        $request->setPost("latPost", 400);
        $res = $DIController->indexActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $request->setPost("coCheck", null);
        $request->setPost("lonPost", null);
        $request->setPost("latPost", null);
    }
}
