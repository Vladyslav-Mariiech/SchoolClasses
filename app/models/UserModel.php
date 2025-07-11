<?php

namespace app\models;

class UserModel extends BaseModel
{
    /**
     * Insert into user in database
     * @param array $user
     * @return bool|array
     */
    public function add(array $user): bool|array
    {
        $hashedPassword = password_hash($user['password'], PASSWORD_BCRYPT);
        return $this->db->query("INSERT INTO users (login, password, email) VALUES (?,?,?)",
        "sss",[$user['login'],$hashedPassword, $user['email']]
        );
    }

    /**
     * Retrieves a user by login name.
     * @param $login
     * @return bool|array
     */
    public function find($login): bool|array
    {
        return $this->db->query("SELECT * FROM users WHERE login = ?",
        "s", [$login]);

    }

}