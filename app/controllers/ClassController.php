<?php

namespace app\controllers;
use app\core\Session;
use app\models\ClassModel;
use app\models\UserClassModel;

class ClassController
{
    protected $UserClassModel;
    protected $ClassModel;
    public function __construct()
    {
        $this->UserClassModel = new UserClassModel();
        $this->ClassModel = new ClassModel();
    }
    //TODO JS?
    public function showCreate ()
    {

    }
    //TODO API?
    public function add (string $name, $ownerId)
    {
        //TODO link
        $newClassId = $this->ClassModel->add($name, 'link5', $ownerId);
        $this->UserClassModel->add($ownerId, $newClassId);
        echo 'Created';
    }

    public static function createLink(int $classId): string
    {
        //TODO Validate
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

    /**
     * Join class handler
     * @return void
     */
    public function join()
    {
        $classId = $_GET['id'] ?? null;

        if (ctype_digit($classId)) {
            (int) $classId;
        }

        if ($classId !== null) {
            //TODO Debug
            // $userId = Session::getSession('user_id');
            $userId = 1;
            $this->UserClassModel->add($userId,$classId);
            //TODO Redirect to class Page
            echo 'Вітаємо в групі';
            exit();
        }
    }
}