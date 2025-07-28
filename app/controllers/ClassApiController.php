<?php

namespace app\controllers;

use app\core\Response;
use app\validations\ValidateNameGroup;

class ClassApiController extends BaseClassController
{
    protected $validateName;
    public function __construct()
    {
        parent::__construct();
        $this->validateName = new ValidateNameGroup();
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

    /**
     * handler form added new group
     * @return void
     */
    public function create(): void
    {
        header('Content-Type: application/json');
        $name = $_POST['name'];
        $errors = $this->validateName->validate($name);

        if(!empty($errors)){
            Response::status(422);
            echo json_encode(['errors' => $errors]);
            return;
        }
        $link = $this->createUniqueId($name);
        $ownerId = $this->userId;
        $classId = $this->ClassModel->add($name, $link, $ownerId);
        if (is_int($classId)) {
            $this->UserClassModel->add($ownerId, $classId);
            echo json_encode(['success' => 'Группа добавлена']);
        } else {
            header('Content-Type: application/json');
            http_response_code(422);
            echo json_encode(['error' => 'Виникла помилка при записі']);
        }
    }
}