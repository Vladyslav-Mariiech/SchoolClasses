<?php

namespace app\core;

use app\controllers\AuthController;
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
        '/api/class/add' => [
            'method' => 'POST',
            'controller' => 'ClassApi',
            'action' => 'create',
        ],
        '/class' => [
            'method' => 'GET',
            'controller' => 'Class',
            'preactions' => [
                [
                    'class' => AuthController::class,
                    'method' => 'checkAccess',
                ],
            ],
        ],
        '/api/class/all' => [
            'method' => 'GET',
            'controller' => 'ClassApi',
            'action' => 'all',
        ],
        '/api/class/owned' => [
            'method' => 'GET',
            'controller' => 'ClassApi',
            'action' => 'owned',
        ],
        '/index/registerPage' => [
            'method' => 'GET',
            'controller' => 'Index',
            'action' => 'register',
        ],
        '/user/add' => [
            'method' => 'POST',
            'controller' => 'User',
            'action' => 'add',
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
        '/assignments/create' => [
            'method' => 'GET',
            'controller' => 'Assignments',
            'action' => 'create'
        ],
        '/assignments/store' => [
            'method' => 'POST',
            'controller' => 'Assignments',
            'action' => 'store'
        ],
        '/submission' => [
            'method' => 'GET',
            'controller' => 'Submission',
            'action' => 'all',
        ],
        '/api/grade/update' => [
            'method' => 'POST',
            'controller' => 'AssignmentAPI',
            'action' => 'update',
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

        if(isset($route['preactions'])){
            $this->preactionsCall($route['preactions']);
        }

        $controller->$action();
    }

    protected function preactionsCall(array $preactions){
        foreach ($preactions as $preaction){
            call_user_func($preaction['class'] . '::' . $preaction['method']);
        }
    }
}