<?php
/**
 * You can call it(app\core\Session::startSession) in the bootstrap,
 * then remove it (self::startSession()) on methods.
 */
namespace app\core;

class Session
{
    /**
     * Starts a session if it hasn't been started yet.
     * Method in start session
     * @return bool
     */
    public static function startSession(): bool
    {
        if(session_status() === PHP_SESSION_NONE){
            return session_start();
        }
        return false;
    }

    /**
     * Stores a key-value pair in the session.
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public static function setSession(string $key, mixed $value): mixed
    {
        self::startSession();
        return $_SESSION[$key] = $value;
    }

    /**
     * Retrieves the value associated with the given session key.
     * @param string $key
     * @return mixed|null
     */
    public static function getSession(string $key): mixed
    {
        self::startSession();
        return $_SESSION[$key] ?? null;
    }

    /**
     * Removes the specified key from the session.
     * @param string $key
     * @return void
     */
    public static function deleteSession(string $key): void
    {
        self::startSession();
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroys the current session if it is active.
     * Method destroy session
     * @return void
     */
    public static function destroySession(): void
    {
      if(session_status() === PHP_SESSION_ACTIVE){

          $_SESSION = [];

          setcookie(session_name(), '', time() - 3600, '/');

          session_destroy();
      }
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function pullSession($key): mixed
    {
        self::startSession();
        $value = $_SESSION[$key] ?? null;
        unset($_SESSION[$key]);
        return $value;
    }
}