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
        '/class' => [
            'method' => 'GET',
            'controller' => 'Class',
            'action' => self::DEFAULT_ACTION,
        ],
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
            $this->notFound();
        }

        $route = self::ROUTES[$uri];

        if (
            $_SERVER['REQUEST_METHOD'] !== $route['method']
        ) {
            Response::status(405);
            exit('Метод не дозволено');
        }

        $controllerClass = 'app\controllers\\' . $route['controller'] . 'Controller';
        if (!class_exists($controllerClass)) {
            $this->notFound();
        }
        $action = $route['action'];
        $controller = new $controllerClass();
        if (!method_exists($controller, $action)) {
            $this->notFound();
        }
        $controller->$action();
    }

    protected function notFound()
    {
        Response::status(404);
        exit('Не знайдено');
    }
}