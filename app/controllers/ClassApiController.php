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
        $allClasses = $this->ClassService->getAll();
        header('Content-Type: application/json');
        echo json_encode($allClasses);
    }

    public function owned()
    {
        $ownedClasses = $this->ClassService->getOwned();
        header('Content-Type: application/json');
        echo json_encode($ownedClasses);
    }
    
    public function create()
    {
        //TODO Validate
        $name = $_POST['name'];
        $link = $this->createUniqueId($name);
        $ownerId = $this->userId;
        //TODO Exeptions
        $classId = $this->ClassModel->add($name, $link, $ownerId);
        if (is_int($classId)) {
            $this->UserClassModel->add($ownerId, $classId);
            echo 'group added';
        } else {
            //TODO Exeptions handler
            //TODO response
            header('Content-Type: application/json');
            http_response_code(422);
            echo '{"error": "Виникла помилка при записі"}';
        }
    }
}