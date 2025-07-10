<?php

namespace app\controllers;
use app\core\Session;
use app\models\UserGroupModel;

class GroupController
{
    protected $UserGroupModel;
    public function __construct()
    {
        $this->UserGroupModel = new UserGroupModel;
    }
    public static function createLink(int $groupId): string
    {
        return '/group/join/?id=' . $groupId;
    }

    public function invite()
    {
        //TODO view Invite Page
        echo '<button><a href="/group/join/?id=1">Прийняти запрошення в групу</a></button>';
    }

    public function join()
    {
        $groupId = $_GET['id'] ?? null;

        if (!ctype_digit($groupId)) {
            $groupId = null;
        }

        if ($groupId !== null) {
            // $userId = Session::getSession('user_id');
            $userId = 1;
            $this->UserGroupModel->add($groupId, $userId);
            //TODO Redirect to Group Page
            echo 'Вітаємо в групі';
            exit();
        }
    }
}