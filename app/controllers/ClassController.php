<?php

namespace app\controllers;
use app\core\Redirect;
use app\core\Session;
use app\core\View;
use app\controllers\BaseClassController;
use app\services\AuthService;

class ClassController extends BaseClassController
{


    protected View $View;
    public function __construct()
    {
        parent::__construct();
        $this->View = new View();
    }

    /**
     * Displays the user’s dashboard page with their owned and joined groups.
     * @return void
     */
    public function index(): void
    {
        $success = Session::pullSession('success');
        $login = AuthService::user()['login'];
        $userId = AuthService::userId();
        $this->View->render('index_myGroups', [
            'title' => 'Мої групи',
            'user_id' => $userId,
            'login' => $login,
            'ownedClasses' => $this->ClassService->getOwned(),
            'memberClasses' => $this->ClassService->getMembered(),
            'success' => $success,

        ]);
    }

    /**
     * Show page with a link to join the class
     * @return void
     */
    public function showInvite(): void
    {
        $className = Session::pullSession('className');
        $success = Session::pullSession('success');
        $error = Session::pullSession('error');
        $classId = $_GET['id'];
        if ($classId !== null && empty($className)) {
            $class = $this->ClassModel->findByLink($classId);
            if ($class && isset($class['name'])) {
                $className = $class['name'];
            }
        }
        $this->View->render('index_inviteToGroup',[
            'classId' => $classId,
            'error' => $error,
            'success' => $success,
            'className' => $className,
            ]);
    }

    /**
     * Join class handler
     * @return void
     */
    public function join(): void
    {
        $link = $_GET['id'] ?? null;
        if($link){
            $class = $this->ClassModel->findByLink($link);
        }
        if (isset($class['id'])){
            $classId = (int)$class['id'];
            $userId = AuthService::userId();
            $className = $class['name'];
            Session::setSession('className', $className);
            if($this->UserClassModel->exists($userId, $classId)){
                Session::setSession('error', 'Вы уже состоите в этой группе');
                Redirect::redirect('/api/class/invite?id=' . $link);
                return;
            }else{
                $this->UserClassModel->add($userId, $classId);
                Session::setSession('success', 'Добро пожаловать в группу ' . $className);
            }
            Redirect::redirect('/class/index');
        }
    }
}

