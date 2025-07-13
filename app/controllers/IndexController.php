<?php

namespace app\controllers;

use app\core\View;


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
}