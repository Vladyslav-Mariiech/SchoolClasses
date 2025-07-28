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
    public function store(int $classId, string $path, ?string $dueDate = null): bool|array
    {
        return $this->db->query("INSERT INTO assignments (class_id, path, due_date) VALUES (?,?,?)",
        "iss", [$classId, $path, $dueDate]);
    }


    /**
     * Retrieves a  class owned by a given user (teacher).
     * @param int $ownerId
     * @param int $classId
     * @return mixed|null
     */
    public function getOneClass( int $ownerId, int $classId): mixed
    {
        $result = $this->db->query("SELECT id, name FROM classes WHERE owner_id = ? AND id = ?",
            "ii", [$ownerId, $classId]);
        if(is_array($result) && !empty($result)){
            return $result[0];
        }
        return null;
    }

    /**
     * Retrieves all assignments for a  class owned by the given user.
     * @param int $ownerId
     * @param int $classId
     * @return bool|array
     */
    public function getAssignmentsForClass(int $ownerId, int $classId): bool|array
    {
        $sql = "SELECT * FROM teacher_assignments_view 
            WHERE owner_id = ? AND class_id = ? 
            ORDER BY assignment_id, user_id";
        return $this->db->query($sql, "ii", [$ownerId, $classId]);
    }

}