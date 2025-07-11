<?php

namespace app\validations;

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
        }else{
            if(mb_strlen($data['login']) < 3){
                $errors['login'] = 'Логин должен быть больше 3 символов';
            }
            if(mb_strlen($data['password']) < 6){
                $errors['password'] = 'Пароль должен быть больше 6 символов';
            }
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Некорректный email';
            }

        }
        return $errors;
    }
}