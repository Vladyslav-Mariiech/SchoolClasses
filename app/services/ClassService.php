<?php

namespace app\services;

use app\models\UserClassModel;

class ClassService
{
    protected UserClassModel $UserClassModel;
    protected array $all = [];
    protected int $userId;
    public function __construct(int $userId)
    {
        $this->userId = $userId;
        $this->loadGroups($userId);
    }

    protected function loadGroups($userId)
    {
        $this->UserClassModel = new UserClassModel();
        $result = $this->UserClassModel->allClasses($userId);
        
        $allClasses = [
            "owner" => [],
            "member" => [],
        ];

        foreach ($result as $class){
            if ($class['owner_id'] === $userId){
                array_push($allClasses['owner'], $class);
            } else{
                array_push($allClasses['member'], $class);
            }
        }

        $this->all = $allClasses;
    }

    public function getAll(): array
    {
        return $this->all;
    }
    public function getOwned():array
    {
        return $this->all['owner'];
    }
    public function getMembered(): array
    {
        return $this->all['member'];
    }
}