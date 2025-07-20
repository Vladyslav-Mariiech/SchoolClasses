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
     * SubmissionController constructor.
     */
    public function __construct()
    {
        $this->view = new View();
        $this->submissionModel = new SubmissionModel();
    }

    /**
     * Show all submissions for the current user.
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
     * Store a new submission.
     * @return void
     */
    public function store(): void
    {
        echo 'SubmissionController store';
    }

}