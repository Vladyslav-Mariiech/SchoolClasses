<?php

namespace app\controllers;

use app\core\Session;
use app\core\View;
use app\controllers\AuthController;
use app\services\AuthService;


class IndexController{
    protected View $view;
    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Handler home page
     * @return void
     */
    public function index(): void
    {
        $errors = Session::getSession('errors');
        Session::deleteSession('errors');
        $this->view->render('index_index', [
            'title' => 'Головна',
            'errors' => $errors,
        ]);
    }

    /**
     * registration new user
     * @return void
     */
    public function register(): void
    {
        $errors = Session::getSession('errors');
        Session::deleteSession('errors');
        $this->view->render('index_register', [
           'title' => 'Реєстрація', 'errors' => $errors,
        ]);
    }

    /**
     * Displays a page with the groups that the currently logged in user is a member of.
     * @return void
     */
    public function myGroups(): void
    {
        AuthService::requireAuth();
        $login = AuthService::user()['login'];
        $userId = AuthService::userId();

        $this->view->render('index_myGroups', [
            'title' => 'MyGroups',
            'login' => $login,
            'id' => $userId,
        ]);
    }
}