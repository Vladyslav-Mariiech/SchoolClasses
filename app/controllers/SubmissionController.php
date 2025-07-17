<?php

namespace app\controllers;

use app\core\View;
use app\models\SubmissionModel;
use app\core\Session;

class SubmissionController
{
    /**
     * @var View
     */
    protected View $view;

    /**
     * @var SubmissionModel
     */
    protected SubmissionModel $submissionModel;

    /**
     *
     */
    public function __construct()
    {
        $this->view = new View();
        $this->submissionModel = new SubmissionModel();
    }

    /**
     * @return void
     */
    public function all(): void
    {
        $userId = 14;
        //$userId = Session::getSession('user_id');
        $submission = $this->submissionModel->getByUserId($userId);
        $this->view->render('index_groupWhereStudent',[
            'title'=>'Submissions',
            'submissions'=>$submission,
            'userId'=>$userId
        ]);
    }

    /**
     * @return void
     */
    public function store(): void
    {
        echo 'SubmissionController store';
    }

}