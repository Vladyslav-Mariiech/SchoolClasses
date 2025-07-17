<?php

namespace app\controllers;

use app\core\View;
use app\models\SubmissionModel;
use app\core\Session;

class SubmissionController
{
    protected View $view;
    protected SubmissionModel $submissionModel;

    public function __construct()
    {
        $this->view = new View();
        $this->submissionModel = new SubmissionModel();
    }
    public function all(): void
    {
        $userId = 1;
        //$userId = Session::getSession('user_id');
        $submission = $this->submissionModel->getByUserId($userId);
        $this->view->render('index_groupWhereStudent',[
            'title'=>'Submissions',
            'submissions'=>$submission,
            'userId'=>$userId
        ]);
    }

    public function store(): void
    {
        echo 'SubmissionController store';
    }

}