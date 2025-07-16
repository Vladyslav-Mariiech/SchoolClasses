<?php

namespace app\models;

use app\core\Database;

class AuthModel
{
    protected Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function validUser(string $login, string $password): bool {
        $result = $this->db->query("SELECT * FROM users WHERE login = ? LIMIT 1", "s", [$login]);

        if (!$result || empty($result)) {
            return false;
        }

        $user = $result[0];

        return password_verify($password, $user['password']);
    }
}