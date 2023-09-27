<?php

$routes = [
    [
        'route' => ['/'],
        'method' => ['GET', 'POST'],
        'script' => 'login.php',
    ],
    [
<<<<<<< HEAD
        'route' => ['/etudiant/dashboard'],
        'method' => ['GET'],
        'script' => 'zut.php',
    ],
    [
=======

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
>>>>>>> fa6137deabcc371ccd691224b3f2301b40d88fe6
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
