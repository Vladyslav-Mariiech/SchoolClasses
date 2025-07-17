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
        $stmt ="
            SELECT 
                sbmsns.id, asnmts.due_date,
                sbmsns.grade, 
                CASE WHEN CURRENT_TIMESTAMP() > asnmts.due_date OR sbmsns.grade = 0 THEN 'Not Passed' ELSE 'Passed' END AS status
            FROM submissions sbmsns 
            INNER JOIN assignments asnmts ON sbmsns.assignment_id = asnmts.id
            WHERE user_id = ?";
        return $this->db->query($stmt, 'i', [$id]);
    }

    public function store(int $assignment_id, string $path, int $userId, int $grade = 0): bool
    {
        $stmt = "INSERT INTO submissions (assignment_id, due_date, path, user_id, grade) VALUES(?, NOW(),?, ?, ?)";
        return $this->db->query($stmt,'isii', [$assignment_id, $path, $userId, $grade]);

    }






}