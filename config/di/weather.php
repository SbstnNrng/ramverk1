<?php
/**
 * Configuration file for weather service.
 */

return [
    // Services to add to the container.
    "services" => [
        "weather" => [
            "shared" => true,
            "callback" => function () {
                $apiKeys = include(__DIR__ . '/../api/keys.php');
                $obj = new \Seb\DIModel\DICheck($apiKeys);
                return $obj;
            }
        ],
    ],
];
