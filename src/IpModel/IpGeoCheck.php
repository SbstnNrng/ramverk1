<?php

namespace Seb\IpModel;

class IpGeoCheck
{
    /**
     * @return string to show the Ip Location.
     */

    public function checkLocation($ipIn) : string
    {
        $key = "c2602d8bc76b1b80bd9196836dd599d3";
        $ch = curl_init('http://api.ipstack.com/'.$ipIn.'?access_key='.$key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($json, true);

        $city = null;
        $country = null;

        if ($ipIn) {
            $country = $res['country_name'];
            $city = $res['city'];
        }
        
        if (!$city || !$country) {
            return "Plats: Hittades ej";
        } else {
            return "Plats: $city, $country";
        }
    }

    /**
     * @return string to show the Ip Cords.
     */

    public function checkCords($ipIn) : string
    {
        $key = "c2602d8bc76b1b80bd9196836dd599d3";
        $ch = curl_init('http://api.ipstack.com/'.$ipIn.'?access_key='.$key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($json, true);

        $lat = null;
        $lon = null;

        if ($ipIn) {
            $lat = $res['latitude'];
            $lon = $res['longitude'];
            $lat = round($lat, 3);
            $lon = round($lon, 3);
        }

        if (!$lat || !$lon) {
            return "Koordinater: Hittades ej";
        } else {
            return "Koordinater: Latitude $lat, Longitude $lon";
        }
    }

    /**
     * @return string to show user IP.
     */

    public function checkUser() : string
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $userIp = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $userIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $userIp = $_SERVER['REMOTE_ADDR'];
        } else {
            $userIp = "1.2.3.4";
        }

        return $userIp;
    }
}
