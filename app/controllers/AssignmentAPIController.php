<?php

namespace app\controllers;

use app\models\SubmissionModel;

class AssignmentAPIController
{
    protected SubmissionModel $submissionModel;

    /**
     * AssignmentAPIController constructor.
     */
    public function __construct()
    {
        $this->submissionModel = new SubmissionModel();
    }

    /**
     * Updates the grade for a submission.
     * @return void
     */
    public function update(): void
    {
        $assignmentId = $_POST['assignment_id'];
        $userId = $_POST['user_id'];
        $grade = $_POST['grade'];
        $res = $this->submissionModel->setGrade($assignmentId, $userId, $grade);
        header('Content-Type: application/json');
        if ($res) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Update failed']);
        }
    }

}