<?php

namespace Seb\DIController;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 *
 */
class DIController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "DI";
        $page = $this->di->get("page");
        $session = $this->di->get("session");

        $lon = $session->get("lon") ?? null;
        $lat = $session->get("lat") ?? null;
        $city = $session->get("city") ?? null;
        $country = $session->get("country") ?? null;
        $error = $session->get("error") ?? null;
        $history = $session->get("history") ?? null;
        $forecast = $session->get("forecast") ?? null;
        $map = $session->get("map") ?? null;

        $data = [
            "history" => $history,
            "forecast" => $forecast,
            "error" => $error,
            "lat" => $lat,
            "lon" => $lon,
            "city" => $city,
            "country" => $country,
            "map" => $map
        ];

        $session->set("lon", null);
        $session->set("lat", null);
        $session->set("city", null);
        $session->set("country", null);
        $session->set("error", null);
        $session->set("history", null);
        $session->set("forecast", null);
        $session->set("map", null);

        $page->add("DI/main", $data);

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

        $diCheck = $this->di->get("weather"); // <------------- egen DI-klass

        $lon = null;
        $lat = null;
        $city = null;
        $country = null;

        $ipCheck = $request->getPost("ipCheck") ?? null;
        $coCheck = $request->getPost("coCheck") ?? null;

        if ($ipCheck) {
            $ipPost = $request->getPost("ipPost");
            $arr = $diCheck->checkCords($ipPost);
            $lon = $arr[0];
            $lat = $arr[1];
            $city = $arr[2];
            $country = $arr[3];
        } elseif ($coCheck) {
            $lon = $request->getPost("lonPost");
            $lat = $request->getPost("latPost");
        }

        $coVali = $diCheck->validateCords($lat, $lon);

        if ($coVali) {
            $session->set("lon", $lon);
            $session->set("lat", $lat);
            $session->set("city", $city);
            $session->set("country", $country);
            $urlsHis = $diCheck->getHistWeatherUrls($lat, $lon);
            $resHistory = $diCheck->curlMulti($urlsHis);
            $urlsFore = $diCheck->getForecastWeatherUrl($lat, $lon);
            $resFore = $diCheck->curlMulti($urlsFore);
            $map = $diCheck->map($lat, $lon);
            $session->set("history", $resHistory);
            $session->set("forecast", $resFore);
            $session->set("map", $map);
        } elseif ($ipCheck) {
            $session->set("error", "IP är fel, kunde inte hitta position");
        } elseif ($coCheck) {
            $session->set("error", "Koordinater är fel, kunde inte hitta position");
        }

        return $response->redirect("di");
    }
}