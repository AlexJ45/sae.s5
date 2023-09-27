<?php

$routes = [
    [
        'route' => ['/'],
        'method' => ['GET', 'POST'],
        'script' => 'login.php',
    ],
    [
        'route' => ['/logout'],
        'method' => ['GET'],
        'script' => 'logout.php',
    ],
    [
        'route' => ['/etudiant/dashboard'],
        'method' => ['GET'],
        'script' => 'etu/dashboard.php',
    ],
    [
        'route' => ['/responsable/dashboard'],
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
];
