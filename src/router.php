<?php

date_default_timezone_set('Europe/Paris');
session_start();

require 'routes.php';

$url = parse_url($_SERVER['REQUEST_URI']);
$route = trim(str_replace(APP_ROOT_URL, '', $url['path']));

$route = $route === '' ? '/' : $route;

foreach ($routes as $r) {
    if (in_array($route, $r['route']) && in_array($_SERVER['REQUEST_METHOD'], $r['method'])) {
        if (str_contains($route, '/responsable')) {
            if (isset($_SESSION['email']) && isset($_SESSION['loaded']) && $_SESSION['loaded'] == true) {
                $user = Formation::getInstance()->findBy(['email_resp_stage' => $_SESSION['email']]);

                $user = $user[0];
                require 'templates/'.$r['script'];
                exit;
            }
            require 'templates/403.php';
            exit;
        }
        if (str_contains($route, '/etudiant')) {
            if (isset($_SESSION['email']) && isset($_SESSION['loaded']) && $_SESSION['loaded'] == true) {
                $user = Etudiant::getInstance()->findBy(['email_etudiant' => $_SESSION['email']]);
                $user = $user[0];
                require 'templates/'.$r['script'];
                exit;
            }
            require 'templates/403.php';
            exit;
        }
        require 'templates/'.$r['script'];
        exit;
    }
}

require 'templates/404.php';
