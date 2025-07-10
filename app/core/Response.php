<?php

namespace app\core;

class Response
{
    public static function status (int $status): void
    {
        http_response_code($status);
    }
}