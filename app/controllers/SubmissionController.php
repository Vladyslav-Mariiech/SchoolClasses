<?php

namespace app\controllers;

use app\core\View;
use app\models\SubmissionModel;
use app\core\Session;
use app\services\AuthService;

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
        $userId = AuthService::userId();
        $login = AuthService::user()['login'];
        var_dump($userId);
        $submission = $this->submissionModel->getByUserId($userId);
        $this->view->render('index_groupWhereStudent',[
            'title'=>'Submissions',
            'submissions'=>$submission,
            'userId'=>$userId,
            'login' => $login
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