<?php

namespace app\exceptions;

class HttpNotFoundException extends HttpException
{
    public function __construct(string $message = "Сторінку не знайдено")
    {
        parent::__construct(404, $message);
    }
}