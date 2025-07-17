<?php

namespace app\controllers;

class ClassApiController extends BaseClassController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $allClasses = $this->ClassService->getOwner();
        header('Content-Type: application/json');
        echo json_encode($allClasses);
    }

    public function create()
    {
        //TODO Validate
        $name = $_POST['name'];
        $link = $this->createUniqueId($name);
        $ownerId = $this->userId;
        //TODO Exeptions
        $this->ClassModel->add($name, $link, $ownerId);
        //TODO response
    }
}