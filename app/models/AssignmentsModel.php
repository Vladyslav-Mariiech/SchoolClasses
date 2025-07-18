<?php

namespace app\models;

class AssignmentsModel extends BaseModel
{
    /**
     * Retrieves all assignments with their due dates and file paths.
     * @return array|bool
     */
    public function all(): bool|array
    {
        return $this->db->query("SELECT due_date, path FROM assignments");
    }

}