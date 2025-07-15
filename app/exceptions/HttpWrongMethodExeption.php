<?php

namespace app\exceptions;

class HttpWrongMethodExeption extends HttpException
{
    public function __construct(string $message = "Метод не підтримується")
    {
        parent::__construct(405, $message);
    }
}