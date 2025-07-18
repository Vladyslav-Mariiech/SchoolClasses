<?php

namespace app\controllers;

use app\core\Session;
use app\core\View;
use app\models\AssignmentsModel;

class AssignmentsController
{
    protected AssignmentsModel $assignmentsModel;

    protected View $view;

    public function __construct()
    {
        $this->assignmentsModel = new AssignmentsModel();
        $this->view = new View();
    }

    /**
     * Displays the teacher's group page with a list of assignments.
     * @return void
     */
    public function index(): void
    {
        $login = Session::getSession('user_login');
        $ownerId = Session::getSession('user_id');
        //TODO add errors or redirect
        $assignments = $this->assignmentsModel->all($ownerId);
        $this->view->render('index_groupWhereTeacher', ['assignments' => $assignments, 'login' => $login]);
    }

}