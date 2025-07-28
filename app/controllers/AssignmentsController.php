<?php

namespace app\controllers;

use app\core\Redirect;
use app\core\Response;
use app\core\Session;
use app\core\View;
use app\models\AssignmentsModel;
use app\services\AuthService;
use app\services\UploadService;

class AssignmentsController
{
    protected AssignmentsModel $assignmentsModel;

    protected View $view;

    protected UploadService $uploadService;

    public function __construct()
    {
        $this->assignmentsModel = new AssignmentsModel();
        $this->view = new View();
        $this->uploadService = new UploadService();
    }

    /**
     * Displays the teacher's group page with a list of assignments.
     * @return void
     */
    public function index(): void
    {
        $login = AuthService::user()['login'];
        $ownerId = AuthService::userId();
        $classId = $_GET['class_id'];
        $className = $this->assignmentsModel->getOneClass($ownerId, $classId);
        $assignments = $this->assignmentsModel->getAssignmentsForClass($ownerId, $classId);
        $this->view->render('index_groupWhereTeacher',
            [
                'assignments' => $assignments,
                'ownerId' => $ownerId,
                'login' => $login,
                'className' => $className,
            ]);
    }
    /**
     * Page with form for create home work
     * @return void
     */
    public function create(): void
    {
        $errors = Session::pullSession('errors');
        $classId = $_GET['class_id'];
        $this->view->render('index_createHomeWork', [
            'errors' => $errors,
            'classId' => $classId,
            ]);
    }

    /**
     * Save new home work
     * @return void
     */
    public function store(): void
    {
        $classId = $_POST['class_id'];
        $deadline = $_POST['deadline'];
        $file = $this->uploadService->uploadedFile('assignment');
        if(!$file){
            Redirect::redirect('/assignments/create?class_id=' . $classId);
            return;
        }
        $this->assignmentsModel->store($classId, $file, $deadline);
        Redirect::redirect('/assignments/index?class_id=' . $classId);
    }
}