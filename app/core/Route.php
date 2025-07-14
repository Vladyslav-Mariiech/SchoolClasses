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
        '/class/invite/' => [
            'method' => 'GET',
            'controller' => 'Class',
            'action' => 'showInvite',
        ],
        '/class/join/' => [
            'method' => 'GET',
            'controller' => 'Class',
            'action' => 'join',
        ],
        '/class/add/' => [
            'method' => 'GET',
            'controller' => 'Class',
            'action' => 'add',
        ],
        '/index/registerPage/' => [
            'method' => 'GET',
            'controller' => 'Index',
            'action' => 'registerPage',
        ],
        '/auth/register' => [
            'method' => 'POST',
            'controller' => 'Auth',
            'action' => 'register',
        ]
    ];
    /**
     * Default controller
     * @var string
     */
    protected const DEFAULT_CONTROLLER = 'Index';
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

        $controllerClass = 'app\controllers\\' . $route['controller'] . 'Controller';
        if (!class_exists($controllerClass)) {
            Response::status(404);
            exit("Контролер $controllerClass не знайдено");
        }
        $action = $route['action'];
        $controller = new $controllerClass();
        if (!method_exists($controller, $action)) {
            Response::status(404);
            exit("Метод $controllerClass $action не знайдено");
        }
        $controller->$action();
    }
//    static public function url(string $controller = 'index', string $action = 'index', array $params = []) : string
//    {
//        $getParams = '';
//        foreach ($params as $key => $value) {
//            $getParams .= $key . '=' . $value . '&';
//        }
//        return '/?controller=' . strtolower($controller) . '&action=' . strtolower($action) . '&' . $getParams;
//    }
}