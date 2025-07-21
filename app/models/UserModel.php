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
     * @param string $login
     * @return bool|array|null
     */
    public function find(string $login): ?array
    {
        $result = $this->db->query("SELECT * FROM users WHERE login = ?",
        "s", [$login]);
        if(is_array($result) && !empty($result)){
            return $result[0];
        }

        return null;
    }

    public function findByEmail(string $email){
        return $this->db->query("SELECT email FROM users WHERE email = ? LIMIT 1", "s", [$email]);
    }

}