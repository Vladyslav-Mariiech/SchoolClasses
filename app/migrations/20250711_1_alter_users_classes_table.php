<?php

use app\core\DataBase;

DataBase::getInstance()->query("
    ALTER TABLE users_classes 
    DROP FOREIGN KEY fk_users_classes_owner_id; 
");

DataBase::getInstance()->query("
    ALTER TABLE users_classes 
    DROP COLUMN owner_id;
");

