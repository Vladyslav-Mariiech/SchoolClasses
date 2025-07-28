<?php

namespace app\models;

class SubmissionModel extends BaseModel
{
    /**
     * Get all submissions.
     * @return array
     */
    public function all(): array
    {
        return $this->db->query("SELECT * FROM submissions");
    }

    /**
     * Retrieves submission data for a user,
     * optionally filtered by class.
     * @param int $userId
     * @param int|null $classId
     * @return array|bool
     */
    private function getSubmission(int $userId, int $classId = null): bool|array
    {

        $stmt = "SELECT assignments.id AS assignment_id,
                    assignments.due_date,
                    CASE WHEN ISNULL(submissions.grade) = 1 THEN '-' ELSE submissions.grade END AS grade,
                    CASE
                        WHEN submissions.id IS NOT NULL AND submissions.grade > 0 THEN 'Checked'
                        WHEN submissions.id IS NOT NULL THEN 'Submitted'
                        WHEN assignments.due_date >= NOW() THEN 'Active'
                        ELSE 'Expired'
                    END AS status,
                    submissions.path
            FROM assignments
            INNER JOIN classes ON assignments.class_id = classes.id
            INNER JOIN users_classes ON users_classes.class_id = classes.id
            LEFT JOIN submissions
                ON submissions.assignment_id = assignments.id
                AND submissions.user_id = users_classes.user_id
            WHERE users_classes.user_id = ?";

        $types = "i";
        $params = [$userId];
        if($classId !== null){
            $stmt .= " AND assignments.class_id = ?";
            $types .= "i";
            $params[] = $classId;
        }
        $stmt .= " ORDER BY assignments.due_date";
        return $this->db->query($stmt, $types, $params);
    }

    /**
     * Get all submissions for a specific user
     * @param int $id
     * @return array|bool
     */
    public function getByUserId(int $id): bool|array
    {
        return $this->getSubmission($id);
    }

    /**
     * Get submissions for a specific user and class
     * @param int $userId
     * @param int $classId
     * @return array|bool
     */
    public function getByUserIdAndClass(int $userId, int $classId): bool|array
    {
        return $this->getSubmission($userId, $classId);
    }

    /**
     * Get class name
     * @param int $classId
     * @return mixed|null
     */
    public function getClassName(int $classId): mixed
    {
        $result = $this->db->query("SELECT name FROM classes WHERE id = ? ", "i", [$classId]);
        if(!empty($result)){
            return $result[0];
        }
        return null;
    }

    /**
     * Store a new submission for a user.
     * @param int $assignment_id
     * @param string $path
     * @param int $userId
     * @param int $grade
     * @return bool
     */
    public function store(int $assignment_id, string $path, int $userId): bool
    {
        $stmt = "INSERT INTO submissions (assignment_id, submission_date, path, user_id, grade) VALUES(?, NOW(),?, ?, 0)";
        return $this->db->query($stmt,'isi', [$assignment_id, $path, $userId]);
    }

    /**
     * Update the grade for a submission.
     * @param int $assignmentId
     * @param int $userId
     * @param int $grade
     * @return bool
     */
    public function setGrade(int $assignmentId, int $userId, int $grade): bool
    {
        $stmt = "UPDATE submissions SET grade = ? WHERE assignment_id = ? AND user_id = ?";
        return $this->db->query($stmt, 'iii', [$grade, $assignmentId, $userId]);
    }

}