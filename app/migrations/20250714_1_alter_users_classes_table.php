<?php

use app\core\DataBase;

DataBase::getInstance()->query("
    CREATE UNIQUE INDEX uniq_user_class ON users_classes (user_id, class_id);
");
