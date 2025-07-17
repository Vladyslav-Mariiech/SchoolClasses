<?php

use app\core\DataBase;

DataBase::getInstance()->query("
    CREATE TABLE IF NOT EXISTS assignments (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        due_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
        path VARCHAR(255) NOT NULL UNIQUE,
        class_id BIGINT UNSIGNED NOT NULL,  
        CONSTRAINT fk_assignments_class_id FOREIGN KEY (class_id) REFERENCES classes(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

