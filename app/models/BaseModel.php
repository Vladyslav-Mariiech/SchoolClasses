<?php

namespace app\models;

use app\core\Database;

class BaseModel
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * BaseModel constuctor
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}