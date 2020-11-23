<?php

namespace Seb\IpController;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Seb\IpModel\IpGeoCheck;
use Seb\IpModel\IpCheck;

/**
 *
 */
class IpGeoController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "IP-Geo";
        $page = $this->di->get("page");
        $session = $this->di->get("session");

        $ip = $session->get("ip") ?? null;
        $location = $session->get("location") ?? null;
        $cords = $session->get("cords") ?? null;
        $ipGeoCheck = new IpGeoCheck();
        $userIp = $ipGeoCheck->checkUser() ?? "8.8.8.8";

        $session->set("ip", null);
        $session->set("location", null);
        $session->set("cords", null);

        $data = [
            "ip" => $ip,
            "location" => $location,
            "cords" => $cords,
            "userIp" => $userIp
        ];

        $page->add("Ip/geo", $data);
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
        $ipGeoCheck = new IpGeoCheck();

        $ip = $ipCheck->checkIp($ipPost);
        $location = $ipGeoCheck->checkLocation($ipPost);
        $cords = $ipGeoCheck->checkCords($ipPost);

        $session->set("ip", $ip);
        $session->set("location", $location);
        $session->set("cords", $cords);

        return $response->redirect("ip-geo");
    }
}
