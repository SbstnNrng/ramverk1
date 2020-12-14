<?php

namespace Seb\DIModel;

class DICheck
{
    public function __construct(array $apiKeys)
    {
        $this->apiKeys = $apiKeys;
    }

    public function checkCords($ipIn) : array
    {
        $key = $this->apiKeys["ipStack"];
        $ch = curl_init('http://api.ipstack.com/'.$ipIn.'?access_key='.$key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($json, true);

        $lon = null;
        $lat = null;
        $city = null;
        $country = null;
        
        if ($ipIn) {
            $lat = $res['latitude'];
            $lon = $res['longitude'];
            $city = $res['city'];
            $country = $res['country_name'];
            $lat = round($lat, 3);
            $lon = round($lon, 3);
        }

        return [$lon, $lat, $city, $country];
    }

    public function validateCords($lat, $lon) : bool
    {
        if ($lat == null || $lon == null) {
            return false;
        }

        $latNum = intval($lat);
        $lonNum = intval($lon);
        
        if ($latNum >= -90 && $latNum <= 90) {
            if ($lonNum >= -180 && $lonNum <= 180) {
                return true;
            }
        }
        return false;
    }

    public function getHistWeatherUrls($lat, $lon) : array
    {
        $key = $this->apiKeys["openWeatherApiKey"];
        $urls = [];
        $oneDayInSec = 60*60*24;
        $timestamp = time();

        for ($i=0; $i < 5; $i++) { 
            $timestamp -= $oneDayInSec;
            $url = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=".$lat."&lon=".$lon."&dt=".$timestamp."&appid=".$key."&units=metric&lang=se";
            array_push($urls, $url);
        }

        return $urls;
    }

    public function getForecastWeatherUrl($lat, $lon) : array
    {
        $key = $this->apiKeys["openWeatherApiKey"];
        $url = [];

        $urlStr = "https://api.openweathermap.org/data/2.5/onecall?lat=".$lat."&lon=".$lon."&exclude=minutely,hourly,current&appid=".$key."&units=metric&lang=se";
        array_push($url, $urlStr);
        return $url;
    }

    public function curlMulti($urls) : array
    {
        $curlOpt = [
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true
        ];

        $multi = curl_multi_init();
        $chArray = [];

        foreach ($urls as $key => $url) {
            $ch = curl_init($url);
            curl_setopt_array($ch, $curlOpt);

            $chArray[$key] = $ch;

            curl_multi_add_handle($multi, $ch);
        }

        $active = null;
        do {
            $mrc = curl_multi_exec($multi, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            while (curl_multi_exec($multi, $active) == CURLM_CALL_MULTI_PERFORM);
        }

        foreach ($chArray as $ch) {
            curl_multi_remove_handle($multi, $ch);
        }
        curl_multi_close($multi);

        $res = [];
        foreach ($chArray as $key => $ch) {
            $strRes = curl_multi_getcontent($ch);
            $json = json_decode($strRes, JSON_UNESCAPED_UNICODE);
            $res[$key] = $json;
        }

        return $res;
    }

    public function map($lat, $lon) : string
    {
        $map = '<iframe width="700" height="500" src="https://www.openstreetmap.org/export/embed.html?bbox=';
        $map = $map.($lon - 10).'%2C'.($lat - 10).'%2C'.($lon + 10).'%2C'.($lat + 10);
        $map = $map.'&amp;layer=mapnik&amp;marker='.$lat."%2C".$lon.'"></iframe>';
        return $map;
    }
}
