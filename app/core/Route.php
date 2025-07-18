<?php

namespace app\core;

use app\exceptions\HttpException;
use app\exceptions\HttpNotFoundException;
use app\exceptions\HttpWrongMethodExeption;


class Route
{
    protected const ROUTES = [
        '/' => [
            'method' => 'GET',
            'controller' => self::DEFAULT_CONTROLLER,
            'action' => self::DEFAULT_ACTION,
        ],
        '/class/invite' => [
            'method' => 'GET',
            'controller' => 'Class',
            'action' => 'showInvite',
        ],
        '/class/join' => [
            'method' => 'GET',
            'controller' => 'Class',
            'action' => 'join',
        ],
        '/class/add' => [
            'method' => 'POST',
            'controller' => 'ClassApi',
            'action' => 'create',
        ],
        '/class' => [
            'method' => 'GET',
            'controller' => 'Class',
        ],
        '/class/all' => [
            'method' => 'GET',
            'controller' => 'ClassApi',
            'action' => 'all',
        ],
        '/index/registerPage' => [
            'method' => 'GET',
            'controller' => 'Index',
            'action' => 'register',
        ],
        '/auth/register' => [
            'method' => 'POST',
            'controller' => 'Auth',
            'action' => 'register',
        ],
        '/auth/login' => [
            'method' => 'POST',
            'controller' => 'Auth',
            'action' => 'login',
        ],
        '/auth/logout' => [
            'method' => 'POST',
            'controller' => 'Auth',
            'action' => 'logout',
        ],
        '/index/myGroupsPage' => [
            'method' => 'GET',
            'controller' => 'Index',
            'action' => 'myGroups',
        ],
        '/assignments/index' => [
            'method' => 'GET',
            'controller' => 'Assignments',
            'action' => 'index',
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
        try {
            $this->init();
        } catch (HttpException $e) {
            exit($e->getMessage());
        }

    }

    public function init(): void
    {
        $uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ?: '/';

        if (!array_key_exists($uri, self::ROUTES)) {
            throw new HttpNotFoundException();
        }

        $route = self::ROUTES[$uri];

        if ($_SERVER['REQUEST_METHOD'] !== $route['method']) {
            throw new HttpWrongMethodExeption();
        }

        $controllerName = $route['controller'];
        $action = $route['action'] ?? self::DEFAULT_ACTION;

        $controllerClass = 'app\controllers\\' . ucfirst($controllerName) . 'Controller';

        if (!class_exists($controllerClass)) {
            throw new HttpNotFoundException();
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            throw new HttpNotFoundException();
        }

        $controller->$action();
    }
}