<?php

namespace Seb\IpController;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Seb\IpModel\IpCheck;

/**
 *
 */
class IpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "IP-Validator";
        $page = $this->di->get("page");
        $session = $this->di->get("session");

        $ip = $session->get("ip") ?? null;
        $domain = $session->get("domain") ?? null;

        $session->set("ip", null);
        $session->set("domain", null);

        $data = [
            "ip" => $ip,
            "domain" => $domain
        ];

        $page->add("Ip/validator", $data);
        // $page->add("Ip/debug");

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * @return object
     */
    public function indexActionPost() : object
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $session = $this->di->get("session");

        $ipPost = $request->getPost("ipPost");
        $ipCheck = new IpCheck();

        $ip = $ipCheck->checkIp($ipPost);
        $domain = $ipCheck->checkDomain($ipPost);

        $session->set("ip", $ip);
        $session->set("domain", $domain);

        return $response->redirect("ip");
    }
}
