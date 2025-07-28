<?php

namespace app\controllers;

use app\core\Redirect;
use app\core\Response;
use app\core\View;
use app\models\AssignmentsModel;
use app\models\SubmissionModel;
use app\core\Session;
use app\services\AuthService;
use app\services\DownloadFileService;
use app\services\UploadService;

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
     * @var UploadService
     */
    protected UploadService $uploadService;

    /**
     * @var DownloadFileService
     */
    protected DownloadFileService $downloadFile;



    /**
     * SubmissionController constructor.
     */
    public function __construct()
    {
        $this->view = new View();
        $this->submissionModel = new SubmissionModel();
        $this->uploadService = new UploadService();
        $this->downloadFile = new DownloadFileService();
    }

    /**
     * Show all submissions for the current user.
     * @return void
     */
    public function all(): void
    {
        $userId = AuthService::userId();
        $login = AuthService::user()['login'];
        $classId = $_GET['class_id'];
        $className = $this->submissionModel->getClassName($classId);
        if($classId !== null){
            $submission = $this->submissionModel->getByUserIdAndClass($userId, $classId);
        }else{
            $submission = $this->submissionModel->getByUserId($userId);
        }
        $this->view->render('index_groupWhereStudent',[
            'title'=>'Submissions',
            'submissions'=>$submission,
            'userId'=>$userId,
            'login' => $login,
            'classId' => $classId,
            'className' => $className,
        ]);
    }

    /**
     * Store a new submission.
     * @return void
     */
    public function store(): void
    {
        $errors = Session::pullSession('errors');
        $assignmentsId = $_GET['id'] ?? null;
        $classId = $_GET['class_id'];
        $this->view->render('index_handinHomeWork', [
            'assignmentsId' => $assignmentsId,
            'classId' => $classId,
            'errors' => $errors,
            ]);

    }

    /**
     * @return void
     */
    public function sendSubmission(): void
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            Response::status(404);
        }
        $assignmentsId = $_POST['assignmentsId'];
        $classId = $_POST['class_id'];
        $userId = AuthService::userId();
        $file = $this->uploadService->uploadedFile('submission');
        if(!$file){
            Redirect::redirect('/submission/store?id=' . $assignmentsId . '&class_id=' . $classId);
            return;
        }
        $this->submissionModel->store($assignmentsId, $file, $userId);
        if($classId !== null){
            Redirect::redirect('/submission/all?class_id=' . $classId);
        }
    }

    /**
     * @return void
     */
    public function downloadFileSubmission(): void
    {
        $file = $_GET['file'] ?? '';
        $this->downloadFile->download('submissions', $file);
    }

}