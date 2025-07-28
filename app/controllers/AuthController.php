<?php

namespace app\controllers;

use app\core\Redirect;
use app\core\Session;
use app\models\UserModel;
Use app\models\AuthModel;
use app\services\AuthService;
use app\validations\ValidateLogin;

class AuthController
{
    protected UserModel $UserModel;
    protected AuthModel $auth;
    protected ValidateLogin $validator;

    public function __construct(){
        $this->UserModel = new UserModel();
        $this->auth = new AuthModel();
        $this->validator = new ValidateLogin();
    }

    /**
     * Processes a user login request.
     * Checks input data, validates login and password
     * @return void
     */
    public function login(): void
    {
        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');
        $errors = $this->validator->validate(['login' => $login, 'password' => $password]);
        if(!empty($errors)){
            Session::setSession('errors', $errors);
            Redirect::redirect('/');
            return;
        }
        if ($this->auth->validUser($login, $password)) {
            $user = $this->UserModel->find($login);
            if ($user) {
                AuthService::login($user);
            }
            Redirect::redirect('/class/index');
        }else{
            Session::setSession('errors', ['common' => 'Неверный логин или пароль']);
            Redirect::redirect('/');
        }
    }

    /**
     * Logs out, removing user data from the session.
     * @return void
     */
    public function logout(): void
    {
        AuthService::logout();
    }

    /**
     * Checks if the user is authorized.
     * If not, redirects to the login page
     * @return void
     */
    public static function checkAccess(): void
    {
        AuthService::requireAuth();
    }
}