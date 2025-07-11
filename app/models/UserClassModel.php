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
     * Returns list of class_id
     * @param int $userId
     * @return array
     */
    public function allClasses(int $userId): array
    {
        $result = $this->db->query(
            'SELECT class_id FROM users_classes WHERE user_id = ?',
            'i',
            [$userId]
        );
        $classes = [];
        if($result){
            foreach($result as $class){
             array_push($classes, $class['class_id']);
            }
        }

        return $classes;
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
        if($result){
            foreach($result as $user){
             array_push($users, $user['user_id']);
            }
        }

        return $users;
    }
}