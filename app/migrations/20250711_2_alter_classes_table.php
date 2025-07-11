<?php

use app\core\Database;

Database::getInstance()->query("
    ALTER TABLE classes 
    ADD COLUMN owner_id BIGINT UNSIGNED NOT NULL;
    ALTER TABLE classes 
    ADD CONSTRAINT fk_classes_owner_id FOREIGN KEY (owner_id) REFERENCES users(id);
");

