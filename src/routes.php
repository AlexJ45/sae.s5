<?php

$routes = [
    [
        'route' => ['/'],
        'method' => ['GET'],
        'script' => 'login.php',
    ],
    [
        'route' => ['/etu/dashboard'],
        'method' => ['GET'],
        'script' => 'etu/dashboard.php',
    ],
    [
        'route' => ['/resp/dashboard'],
        'method' => ['GET'],
        'script' => 'resp/dashboard.php',
    ],

    [
        'route' => ['/404'],
        'method' => ['GET'],
        'script' => '404.php',
    ],
    [
        'route' => ['/403'],
        'method' => ['GET'],
        'script' => '403.php',
    ],
    [
        'route' => ['/301'],
        'method' => ['GET'],
        'script' => '301.php',
    ],
];
