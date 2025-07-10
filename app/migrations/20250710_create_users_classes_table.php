<?php

use app\core\Database;

Database::getInstance()->query("
    CREATE TABLE IF NOT EXISTS users_classes (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT UNSIGNED NOT NULL,
        class_id BIGINT UNSIGNED NOT NULL,
        owner_id BIGINT UNSIGNED NOT NULL,
        CONSTRAINT fk_users_classes_user_id FOREIGN KEY (user_id) REFERENCES users(id),
        CONSTRAINT fk_users_classes_class_id FOREIGN KEY (class_id) REFERENCES classes(id),
        CONSTRAINT fk_users_classes_owner_id FOREIGN KEY (owner_id) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

