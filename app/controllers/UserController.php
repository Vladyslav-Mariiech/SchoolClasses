<?php

namespace app\controllers;

use app\core\Redirect;
use app\core\Session;
use app\models\UserModel;
use app\services\AuthService;
use app\validations\ValidateUser;

class UserController
{
    protected UserModel $userModel;

    protected ValidateUser $validate;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validate = new ValidateUser();
    }

    /**
     * Add new user
     * @return void
     */
    public function add(): void
    {
        $user = [
            'login' => $_POST['login'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'passConfirm' => $_POST['passConfirm'],
            ];
        $errors = $this->validate->userValidate($user);
        if(!empty($errors)){
            Session::setSession('errors', $errors);
            Redirect::redirect('/index/registerPage/');
        }
        $this->userModel->add($user);
        $registered = $this->userModel->find($user['login']);
        AuthService::login($registered);
        Redirect::redirect('/index/myGroupsPage');
    }

    /**
     * Finds a user by login name
     * @param string $name
     * @return array|bool
     */
    public function find(string $name): array|bool
    {
        if(empty($name)){
            return false;
        }
        return $this->userModel->find($name);
    }

}