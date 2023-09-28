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
        'method' => ['GET', 'POST'],
        'script' => 'etu/dashboard.php',
    ],
    [
        'route' => ['/responsable/dashboard'],
        'method' => ['GET', 'POST'],
        'script' => 'responsable/dashboard.php',
    ],
    [
        'route' => ['/mail'],
        'method' => ['GET', 'POST'],
        'script' => 'envoyer-email.php',
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
