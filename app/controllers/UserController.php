<?php

namespace app\controllers;

use app\core\Session;
use app\models\UserModel;
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
            'password' => $_POST['password'],
            'email' => $_POST['email'],
            ];
        $errors = $this->validate->userValidate($user);
        if(!empty($errors)){
            Session::setSession('errors', $errors);
            return;
        }
        $this->userModel->add($user);
    }

    /**
     * Finds a user by login name
     * @param $name
     * @return void
     */
    public function find(string $name): void
    {
        if(empty($name)){
            Session::setSession('error', 'login not found');
            return;
        }
        $this->userModel->find($name);
    }

}