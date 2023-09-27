<?php

$routes = [
    [
        'route' => ['/'],
        'method' => ['GET', 'POST'],
        'script' => 'login.php',
    ],
    [

        'route' => ['/etudiant/dashboard'],
        'method' => ['GET'],
        'script' => 'etu/dashboard.php',
    ],
    [
        'route' => ['/responsable/dashboard'],
        'method' => ['GET', 'POST'],
        'script' => 'responsable/dashboard.php',
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
