<?php

use app\core\DataBase;

DataBase::getInstance()->query("
    CREATE TABLE IF NOT EXISTS submissions (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        assignment_id BIGINT UNSIGNED NOT NULL,
        submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
        path VARCHAR(255) NOT NULL UNIQUE,
        user_id BIGINT UNSIGNED NOT NULL,
        grade TINYINT UNSIGNED NOT NULL CHECK (grade < 5),
        CONSTRAINT fk_submissions_assignment_id FOREIGN KEY (assignment_id) REFERENCES assignments(id),
        CONSTRAINT fk_submissions_user_id FOREIGN KEY (user_id) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

