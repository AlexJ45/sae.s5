<?php

$routes = [
    [
        'route' => ['/'],
        'method' => ['GET'],
        'script' => 'login.php',
    ],
    [
        'route' => ['/responsable/dashboard'],
        'method' => ['GET'],
        'script' => '/responsable/dashbaord.php',
    ],
    [
        'route' => ['/etudiant/dashboard'],
        'method' => ['GET'],
        'script' => '/etudiant/dashbaord.php',
    ],
    [
        'route' => ['/'],
        'method' => ['GET'],
        'script' => 'login.php',
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
