<?php

namespace app\models;
//TODO Exceptions
class UserClassModel extends BaseModel
{
    /**
     * Add user to existing class
     * @param int $userId
     * @param int $classId
     * @return void
     */
    public function add(int $userId, int $classId)
    {
        $this->db->query(
            'INSERT INTO users_classes (user_id, class_id) VALUES (?, ?)',
            'ii',
            [$userId, $classId]
        );
    }

    /**
     * Returns classes array
     * @param int $userId
     * @return array
     */
    public function allClasses(int $userId): array
    {
        $result = $this->db->query(
            'SELECT users_classes.class_id, classes.name, classes.link, classes.owner_id FROM users_classes 
            INNER JOIN classes 
            ON users_classes.class_id = classes.id
            WHERE users_classes.user_id = ?',
            'i',
            [$userId],
        );

        return $result;
    }

    /**
     * Returns list of user_id
     * @param int $classId
     * @return array
     */
    public function allUsers(int $classId): array
    {
        $result = $this->db->query(
            'SELECT user_id FROM users_classes WHERE class_id = ?',
            'i',
            [$classId]
        );
        $users = [];
        if ($result) {
            foreach ($result as $user) {
                array_push($users, $user['user_id']);
            }
        }

        return $users;
    }

    /**
     * Checks if the user is in a class
     * @param int $userId
     * @param int $classId
     * @return bool
     */
    public function exists(int $userId, int $classId){
        $result = $this->db->query("SELECT 1 FROM users_classes WHERE user_id = ? AND class_id = ? LIMIT 1",
        "ii", [$userId, $classId]);

        return !empty($result);
    }
}