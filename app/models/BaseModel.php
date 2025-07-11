<?php

namespace app\models;

use app\core\DataBase;

class BaseModel
{
    /**
     * @var DataBase
     */
    protected $db;

    /**
     * BaseModel constuctor
     */
    public function __construct()
    {
        $this->db = DataBase::getInstance();
    }
}