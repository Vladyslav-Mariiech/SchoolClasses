<?php

namespace app\services;

use app\core\Redirect;
use app\core\Session;

class AuthService
{
    /**
     * Authorizes the user by saving his ID and login in the session.
     * @param array $user
     * @return void
     */
    public static function login(array $user): void
    {
        Session::setSession('user', ['id' => $user['id'], 'login' => $user['login'] ]);
    }

    /**
     * Completes user authorization:
     * removes the user from the session, destroys the session and redirects to the main page.
     * @return void
     */
    public static function logout(): void
    {
        Session::deleteSession('user');
        Session::destroySession();
        Redirect::redirect('/');
    }

    /**
     * Returns the current logged, in user data from the session
     * @return mixed|null
     */
    public static function user(): mixed
    {
        return Session::getSession('user');
    }

    /**
     * Returns the current user ID.
     * @return mixed|null
     */
    public static function userId(): mixed
    {
        return self::user()['id'] ?? null;
    }

    /**
     * Checks if the user is authorized.
     * If not, redirects to the login page.
     * @return void
     */
    public static function requireAuth(): void
    {
        if(!self::userId()){
            Redirect::redirect('/');
        }
    }

}