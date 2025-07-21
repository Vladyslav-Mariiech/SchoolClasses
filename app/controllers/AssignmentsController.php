<?php

namespace app\controllers;

use app\core\Redirect;
use app\core\Session;
use app\core\View;
use app\models\AssignmentsModel;
use app\services\AuthService;

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
        $login = AuthService::user()['login'];
        $ownerId = AuthService::userId();
        $assignments = $this->assignmentsModel->all($ownerId);
        $this->view->render('index_groupWhereTeacher', [
                'assignments' => $assignments,
                'ownerId' => $ownerId, 'login' => $login,
                ]);
    }

    /**
     * Page with form for create home work
     * @return void
     */
    public function create(): void
    {
        $errors = Session::getSession('errors');
        Session::deleteSession('errors');
        $ownerId = AuthService::userId();
        $classes = $this->assignmentsModel->getTeacherClasses($ownerId);
        $this->view->render('index_createHomeWork', ['classes' => $classes, 'errors' => $errors]);
    }

    /**
     * Save new home work
     * @return void
     */
    public function store(): void
    {
        $classId = $_POST['class_id'];
        $deadline = $_POST['deadline'];
        $file = $_FILES['file']['name'];

        if (!$classId || !$file) {
            Session::setSession('errors', 'выберете файл и имя класса');
            Redirect::redirect('/assignments/create');
        }
        // i dont no where redirect
        $this->assignmentsModel->store($classId, $file, $deadline);
        Redirect::redirect('/assignments/index');
    }


}