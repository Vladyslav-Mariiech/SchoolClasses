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

    /**
     * Save in database new home work
     * @param int $classId
     * @param string $path
     * @param string|null $dueDate
     * @return array|bool
     */
    public function store(int $classId, string $path, ?string $dueDate = null)
    {
        return $this->db->query("INSERT INTO assignments (class_id, path, due_date) VALUES (?,?,?)",
        "iss", [$classId, $path, $dueDate]);
    }

    /**
     * Show class name where user teacher
     * @param int $ownerId
     * @return array|bool
     */
    public function getTeacherClasses(int $ownerId): array|bool
    {
        return $this->db->query("SELECT id, name FROM classes WHERE owner_id = ?", "i", [$ownerId]);
    }
}