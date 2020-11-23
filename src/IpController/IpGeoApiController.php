<?php

namespace Seb\IpController;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Seb\IpModel\IpGeoCheck;
use Seb\IpModel\IpCheck;

/**
 *
 */
class IpGeoApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "IP-Geo-Api";
        $page = $this->di->get("page");

        $userIp = $_SERVER['REMOTE_ADDR'] ?? "8.8.8.8";
        
        $data = [
            "userIp" => $userIp
        ];

        $page->add("Ip/geo-api", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     *
     * @return object
     */
    public function jsonIpGeoActionGet() : array
    {
        $IpCheck = new IpCheck();
        $IpGeoCheck = new IpGeoCheck();

        $request = $this->di->get("request");
        $ip  = $request->getGet("ip", "");

        $state = $IpCheck->checkIp($ip);
        $location = $IpGeoCheck->checkLocation($ip);
        $cords = $IpGeoCheck->checkCords($ip);
        $obj = [
            'ip' => $ip,
            'ip-state' => $state,
            'location' => $location,
            'cords' => $cords
        ];

        return [$obj];
    }

    /**
     *
     * @return object
     */
    public function jsonIpGeoActionPost() : array
    {
        $IpCheck = new IpCheck();
        $IpGeoCheck = new IpGeoCheck();

        $request = $this->di->get("request");
        $ip  = $request->getPost("ipPost");

        $state = $IpCheck->checkIp($ip);
        $location = $IpGeoCheck->checkLocation($ip);
        $cords = $IpGeoCheck->checkCords($ip);
        $obj = [
            'ip' => $ip,
            'ip-state' => $state,
            'location' => $location,
            'cords' => $cords
        ];

        return [$obj];
    }
}
