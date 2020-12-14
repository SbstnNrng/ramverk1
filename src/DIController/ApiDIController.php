<?php

namespace Seb\DIController;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;


/**
 *
 */
class ApiDIController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "DI-API";
        $page = $this->di->get("page");

        $page->add("DI/api");

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     *
     * @return object
     */
    public function jsonDIActionGet() : array
    {
        $DICheck = $this->di->get("weather");
        $request = $this->di->get("request");

        $ip = $request->getGet("ip", "") ?? null;
        $lat = $request->getGet("lat", "") ?? null;
        $lon = $request->getGet("lon", "") ?? null;

        $arr = null;
        $obj = null;

        if ($ip) {
            $arr = $DICheck->checkCords($ip);
            $lon = $arr[0];
            $lat = $arr[1];
        }

        $coVali = $DICheck->validateCords($lat, $lon);

        if ($coVali) {
            $urlsHis = $DICheck->getHistWeatherUrls($lat, $lon);
            $resHistory = $DICheck->curlMulti($urlsHis);
            $urlsFore = $DICheck->getForecastWeatherUrl($lat, $lon);
            $resFore = $DICheck->curlMulti($urlsFore);
            $obj = [
                'forecast' => $resHistory,
                'history' => $resFore
            ];
        } else {
            $obj = [
                'error' => "Use query [/di-api/jsonDI?ip=[ip] or /di-api/jsonDI?lat=[lat]&lon=[lon]]"
            ];
        }
        return [$obj];
    }

    /**
     *
     * @return object
     */
    public function jsonDIActionPost() : array
    {
        $DICheck = $this->di->get("weather");
        $request = $this->di->get("request");

        $ip = $request->getPost("ipPost");
        $lat = $request->getPost("latPost");
        $lon = $request->getPost("lonPost");

        $arr = null;
        $obj = null;

        if ($ip) {
            $arr = $DICheck->checkCords($ip);
            $lon = $arr[0];
            $lat = $arr[1];
        }

        $coVali = $DICheck->validateCords($lat, $lon);

        if ($coVali) {
            $urlsHis = $DICheck->getHistWeatherUrls($lat, $lon);
            $resHistory = $DICheck->curlMulti($urlsHis);
            $urlsFore = $DICheck->getForecastWeatherUrl($lat, $lon);
            $resFore = $DICheck->curlMulti($urlsFore);
            $obj = [
                'forecast' => $resHistory,
                'history' => $resFore
            ];
        } else {
            $obj = [
                'error' => "Use query [/di-api/jsonDI?ip=[ip] or /di-api/jsonDI?lat=[lat]&lon=[lon]]"
            ];
        }
        return [$obj];
    }
}
