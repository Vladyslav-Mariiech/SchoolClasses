<?php

namespace app\exceptions;

use Exception;
use app\core\Response;

class HttpException extends Exception
{
    public function __construct(int $statusCode, string $message, \Throwable $previous = null)
    {
        Response::status($statusCode);
        parent::__construct($message, $statusCode, $previous);
    }
}