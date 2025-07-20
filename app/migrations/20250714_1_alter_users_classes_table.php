<?php

use app\core\DataBase;

DataBase::getInstance()->executeDDL("
    CREATE UNIQUE INDEX uniq_user_class ON users_classes (user_id, class_id);
");
