<?php

namespace app\controllers;

use app\models\UserModel;
Use app\models\AuthModel;
use app\exceptions\HttpUnauthorizedException;

class AuthController
{
    protected $UserModel;
    protected $auth;

    public function __construct(){
        $this->UserModel = new UserModel();
        $this->auth = new AuthModel();
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
        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');
        if ($this->auth->validUser($login, $password)) {
            \app\core\Session::setSession('user', [
                'login' => $login,
            ]);
            header('Location: /index/myGroupsPage/');
            exit;
        } else {
            echo 'Some error when Login';
        }
    }
    public function logout(){
        $_SESSION = [];

        session_destroy();

        if(ini_get('session.use_cookies')){
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        header('Location: /');
        exit;
    }

    public static function checkAccess(): void {
        if (!\app\core\Session::getSession('user')) {
            header('Location: /');
        }
    }
}