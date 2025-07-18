<?php

namespace app\models;

class AssignmentsModel extends BaseModel
{
    /**
     * Retrieves all assignments with their due dates and file paths.
     * @param int $ownerId
     * @return array|bool
     */
    public function all(int $ownerId): bool|array
    {
        $sql = "SELECT * FROM teacher_assignments_view WHERE owner_id = ? ORDER BY class_id, assignment_id, user_id";
        return $this->db->query($sql, "i", [$ownerId]);
    }
}