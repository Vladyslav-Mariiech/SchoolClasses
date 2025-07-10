<?php

namespace app\core;

class Route
{
    protected const ROUTES = [
        '/' => [
            'method' => 'GET',
            'controller' => self::DEFAULT_CONTROLLER,
            'action' => self::DEFAULT_ACTION,
        ],
        '/index/index/' => [
            'method' => 'GET',
            'controller' => self::DEFAULT_CONTROLLER,
            'action' => self::DEFAULT_ACTION,
        ],
    ];
    /**
     * Default controller
     * @var string
     */
    protected const DEFAULT_CONTROLLER = 'index';
    /**
     * Default action
     * @var string
     */
    protected const DEFAULT_ACTION = 'index';

    public function __construct()
    {
        $this->init();
    }

    public function init(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if (!array_key_exists($uri, self::ROUTES)) {
            Response::status(404);
            exit();
        }
        
        $route = self::ROUTES[$uri];
        
        if (
            $_SERVER['REQUEST_METHOD'] !== $route['method']
        ) {
            Response::status(405);
            exit();
        }
        
        $controllerClass = 'app\controllers\\' . ucfirst($route['controller'] . 'Controller');
        $action = $route['action'];
        $controller = new $controllerClass();
        $controller->$action();
    }
}