<?php

namespace app\controllers;

use app\models\ClassModel;
use app\services\AuthService;
use app\services\ClassService;
use app\core\Session;
use app\models\UserClassModel;


class BaseClassController
{
    protected int $userId;
    protected ClassService $ClassService;
    protected ClassModel $ClassModel;
    protected UserClassModel $UserClassModel;

    public function __construct()
    {
        AuthController::checkAccess();
        $this->userId = AuthService::userId();
        $this->ClassService = new ClassService($this->userId);
        $this->ClassModel = new ClassModel();
        $this->UserClassModel = new UserClassModel();
    }

    public static function createUniqueId(string $name): string
    {
        return md5($name . time());
    }
}