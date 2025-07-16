<?php

namespace app\exceptions;

class HttpUnauthorizedException extends HttpException
{
    public function __construct(string $message = "Доступ заборонено. Користувач не авторизований.")
    {
        parent::__construct(401, $message);
    }
}