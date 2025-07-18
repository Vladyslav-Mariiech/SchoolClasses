<?php

require_once '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'cred.php';
require_once 'core/DataBase.php';
require_once 'core/MigrationManager.php';

use app\core\MigrationManager;

$migrationsPath = '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'migrations';
$manager = new MigrationManager($migrationsPath);
$manager->migrate();
