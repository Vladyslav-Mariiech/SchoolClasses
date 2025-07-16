<?php

namespace app\controllers;

use app\core\View;
use app\controllers\AuthController;


class IndexController{
    protected View $view;
    public function __construct()
    {
        $this->view = new View();
    }
    public function index()
    {
        $this->view->render('index_index', [
            'title' => 'Головна',
        ]);
    }
    public function register() {
        $this->view->render('index_register', [
           'title' => 'Реєстрація',
        ]);
    }
    public function myGroups() {
        \app\controllers\AuthController::checkAccess();

        $this->view->render('index_myGroups', [
            'title' => 'MyGroups',
        ]);
    }
}