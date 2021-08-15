<?php

namespace Seb\Book;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;

/**
 * IpCheck test class.
 */
class BookTest extends TestCase
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

    public function testBook()
    {
        $book = new Book();
        $book->setDb($this->di->get("dbqb"));
        $this->assertIsObject($book);
    }

    public function testCreateForm()
    {
        $book = new Book();
        $book->setDb($this->di->get("dbqb"));
        $bookForm = new HTMLForm\CreateForm($this->di, 2);
        $this->assertIsObject($bookForm);
    }

    public function testDeleteForm()
    {
        $book = new Book();
        $book->setDb($this->di->get("dbqb"));
        $bookForm = new HTMLForm\DeleteForm($this->di, 2);
        $this->assertIsObject($bookForm);
    }

    public function testUpdateForm()
    {
        $book = new Book();
        $book->setDb($this->di->get("dbqb"));
        $bookForm = new HTMLForm\UpdateForm($this->di, 2);
        $this->assertIsObject($bookForm);
    }

    public function testBookController()
    {
        $bookController = new BookController();
        $bookController->setDI($this->di);
        $res = $bookController->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $bookController->createAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $bookController->deleteAction(1);
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $bookController->updateAction(1);
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
