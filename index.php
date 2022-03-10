<?php

use App\database\Database;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

class Application
{
    const AUTHORIZED_PAGES = [
        'AllMovies' => [
            'controller' => 'AllMoviesController',
            'method' => 'index'
        ],
        'AddMovies' => [
            'controller' => 'AllMoviesController',
            'method' => 'create'
        ],
        'RemoveMovies' => [
            'controller' => 'AllMoviesController',
            'method' => 'remove'
        ],
        'SelectUpdateMovies' => [
            'controller' => 'AllMoviesController',
            'method' => 'selectUpdate'
        ],
        'error404' => [
            'controller' => 'ErrorController',
            'method' => 'error404'
        ],
    ];

    const DEFAULT_ROUTE = 'AllMovies';

    private function match($route_name)
    {
        // je vérifie si la clef existe dans la liste des pages autorisées
        if (isset(self::AUTHORIZED_PAGES[$route_name])) {
            $route = self::AUTHORIZED_PAGES[$route_name];
        } else {
            $route = self::AUTHORIZED_PAGES['error404'];
        }

        return $route;
    }

    public function run()
    {
        // je récupère la route demandée dans l'url
        // si la page n'est pas spécifiée (ex: on arrive pour la première fois sur le site)
        // on redirige vers la page d'accueil
        $route_name = $_GET['page'] ?? self::DEFAULT_ROUTE;

        // je vérifie si la route demandée existe
        $route = $this->match($route_name);

        // dump($route);

        // j'instancie le controller correspondant à la route demandée
        $controller_name = 'App\Controller\\' . $route['controller'];
        $controller = new $controller_name();
        // j'appelle la méthode correspondante à la route demandée
        $method_name = $route['method'];
        $controller->$method_name();

    }
}

$application = new Application();
$application->run();