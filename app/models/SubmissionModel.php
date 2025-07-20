<?php

namespace app\models;

class SubmissionModel extends BaseModel
{
    /**
     * @return array
     */
    public function all(): array
    {
        return $this->db->query("SELECT * FROM submissions");
    }

    /**
     * @param int $id
     * @return array
     */
    public function getByUserId(int $id): array
    {
        $stmt ="SELECT assignments.id, assignments.due_date, 
                CASE WHEN ISNULL(submissions.grade) = 1 THEN '-' ELSE submissions.grade END AS grade, 
                CASE 
                    WHEN assignments.due_date >= NOW() THEN 'Active'
                    ELSE 'Expired'
                END AS status, submissions.path 
            FROM assignments
            INNER JOIN classes ON assignments.class_id = classes.id
            INNER JOIN users_classes ON users_classes.class_id = classes.id
            LEFT JOIN submissions 
                ON submissions.assignment_id = assignments.id 
                AND submissions.user_id = users_classes.user_id 
            WHERE users_classes.user_id = ?
            ORDER BY assignments.due_date;";
        return $this->db->query($stmt, 'i', [$id]);
    }

    /**
     * @param int $assignment_id
     * @param string $path
     * @param int $userId
     * @param int $grade
     * @return bool
     */
    public function store(int $assignment_id, string $path, int $userId, int $grade = 0): bool
    {
        $stmt = "INSERT INTO submissions (assignment_id, submission_date, path, user_id, grade) VALUES(?, NOW(),?, ?, 0)";
        return $this->db->query($stmt,'isii', [$assignment_id, $path, $userId, $grade]);

    }

    /**
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