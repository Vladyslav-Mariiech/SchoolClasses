<?php

use app\core\DataBase;

DataBase::getInstance()->query("
    CREATE TABLE IF NOT EXISTS classes (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL UNIQUE,
        link VARCHAR(255) NOT NULL UNIQUE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");