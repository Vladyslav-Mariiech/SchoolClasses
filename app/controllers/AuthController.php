<?php

namespace app\controllers;

use app\models\UserModel;

class AuthController
{
    protected $UserModel;

    public function __construct(){
        $this->UserModel = new UserModel();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index/registerPage/');
            exit;
        }

        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';

        if (empty($login) || empty($password) || empty($email)) {
            echo ERRORS_MESSAGES[0];
            return;
        }

        if ($this->UserModel->find($login)) {
            echo ERRORS_MESSAGES[1];
            return;
        }

        $result = $this->UserModel->add([
            'login' => $login,
            'password' => $password,
            'email' => $email,
        ]);
        //TODO redirect to default page or fix it somehow
        if ($result) {
            header('Location: /index/index/');
        } else {
            echo ERRORS_MESSAGES[2];
        }
    }
    public function login(){

    }
    public function logout(){

    }
}