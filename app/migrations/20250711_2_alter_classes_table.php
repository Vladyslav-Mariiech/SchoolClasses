<?php

use app\core\DataBase;

DataBase::getInstance()->query("
    ALTER TABLE classes 
    ADD COLUMN owner_id BIGINT UNSIGNED NOT NULL;
");

DataBase::getInstance()->query("
    ALTER TABLE classes 
    ADD CONSTRAINT fk_classes_owner_id FOREIGN KEY (owner_id) REFERENCES users(id);
");


