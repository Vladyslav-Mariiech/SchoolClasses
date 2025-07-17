<?php

use app\core\DataBase;

DataBase::getInstance()->query("
    ALTER TABLE submissions DROP CHECK submissions_chk_1;
");

DataBase::getInstance()->query("
    ALTER TABLE submissions ADD CONSTRAINT submissions_chk_1 CHECK (grade <= 5);
");


