<?php

use app\core\Database;

Database::getInstance()->query("
    ALTER TABLE users_classes 
    DROP FOREIGN KEY fk_users_classes_owner_id; 
");

Database::getInstance()->query("
    ALTER TABLE users_classes 
    DROP COLUMN owner_id;
");

