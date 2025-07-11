<?php

namespace app\controllers;
use app\core\Session;
use app\models\UserClassModel;

class ClassController
{
    protected $UserClassModel;
    public function __construct()
    {
        $this->UserClassModel = new UserClassModel;
    }
    public static function createLink(int $classId): string
    {
        return '/class/join/?id=' . $classId;
    }
    /**
     * Show page with a link to join the class
     * @return void
     */
    public function showInvite()
    {
        //TODO view Invite Page
        echo '<button><a href="/class/join/?id=1">Прийняти запрошення в групу</a></button>';
    }

    public function join()
    {
        $classId = $_GET['id'] ?? null;

        if (!ctype_digit($classId)) {
            $classId = null;
        }

        if ($classId !== null) {
            // $userId = Session::getSession('user_id');
            $userId = 1;
            $this->UserClassModel->add($classId, $userId);
            //TODO Redirect to class Page
            echo 'Вітаємо в групі';
            exit();
        }
    }
}