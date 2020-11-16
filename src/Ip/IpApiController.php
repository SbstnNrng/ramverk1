<?php

namespace Seb\Ip;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 *
 */
class IpApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "IP-API";
        $page = $this->di->get("page");

        $page->add("Ip/api");

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     *
     * @return object
     */
    public function jsonIpActionGet() : array
    {
        $IpCheck = new IpCheck();

        $request = $this->di->get("request");
        $ip  = $request->getGet("ip", "");

        $state = $IpCheck->checkIp($ip);
        $domain = $IpCheck->checkDomain($ip);
        $obj = [
            'ip' => $ip,
            'ip-state' => $state,
            'domain' => $domain
        ];

        return [$obj];
    }

    /**
     *
     * @return object
     */
    public function jsonIpActionPost() : array
    {
        $IpCheck = new IpCheck();

        $request = $this->di->get("request");
        $ip  = $request->getPost("ipPost");

        $state = $IpCheck->checkIp($ip);
        $domain = $IpCheck->checkDomain($ip);
        $obj = [
            'ip' => $ip,
            'ip-state' => $state,
            'domain' => $domain
        ];

        return [$obj];
    }
}
