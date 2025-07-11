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