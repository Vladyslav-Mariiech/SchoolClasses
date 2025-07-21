<?php

namespace app\core;

class Redirect
{
    /**
     * @param string $url
     * @return void
     */
    public static function redirect(string $url) : void
    {
        header('Location: ' . $url);
        exit;
    }

}