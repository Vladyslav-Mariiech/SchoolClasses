<?php

namespace app\controllers;
use app\core\View;
use app\models\ClassModel;
use app\models\UserClassModel;
use app\controllers\BaseClassController;

class ClassController extends BaseClassController
{
    protected UserClassModel $UserClassModel;

    protected View $View;
    public function __construct()
    {
        parent::__construct();
        $this->UserClassModel = new UserClassModel();

        $this->View = new View();
    }

    public function index()
    {     
        $this->View->render('index_myGroups', [
            'title' => 'Мої групи',
            'user_id' => $this->userId,
            'ownedClasses' => $this->ClassService->getOwner(),
            'memberClasses' => $this->ClassService->getMember(),
        ]);
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
            $this->UserClassModel->add($userId, $classId);
            //TODO Redirect to class Page
            echo 'Вітаємо в групі';
            exit();
        }
    }
}

