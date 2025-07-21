<?php

namespace app\validations;

use app\models\UserModel;

class ValidateUser
{
    /**
     * Validates user data
     * @param array $data
     * @return array
     */
    public function userValidate(array $data) : array
    {
        $errors = [];
        if(empty($data['login']) || empty($data['password']) || empty($data['email'])){
            $errors['common'] = 'Все поля должны быть заполнены';
            return $errors;
        }
            if(mb_strlen($data['login']) < 3){
                $errors['login'] = 'Логин должен быть больше 3 символов';
            }
            if(mb_strlen($data['password']) < 6){
                $errors['password'] = 'Пароль должен быть больше 6 символов';
            }
            if(!empty($data['passConfirm']) && $data['passConfirm'] !== $data['password']){
                $errors['passConfirm'] = 'Пароль не совпадает';
            }
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Некорректный email';
            }
            $userModel = new UserModel();
            if($userModel->find($data['login'])){
                $errors['login'] = 'Login уже используется';
            }
            if($userModel->findByEmail($data['email'])){
                $errors['email'] = 'Email уже зарегистрирован';
            }

        return $errors;
    }
}