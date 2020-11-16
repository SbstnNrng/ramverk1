<?php
/**
 * Routes to ease testing.
 */
return [
    // Path where to mount the routes, is added to each route path.
    // "mount" => "sample",

    // All routes in order
    "routes" => [
        [
            "info" => "IP-Validator",
            "mount" => "ip",
            "handler" => "\Seb\Ip\IpController",
        ],
    ]
];
