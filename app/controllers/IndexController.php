<?php

namespace app\controllers;

use app\core\Session;
use app\core\View;


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
        $errors = Session::pullSession('errors');
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
        $errors = Session::pullSession('errors');
        $this->view->render('index_register', [
           'title' => 'Реєстрація', 'errors' => $errors,
        ]);
    }

}