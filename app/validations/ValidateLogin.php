<?php

namespace app\validations;

class ValidateLogin
{
    /**
     * Validate input login and password user
     * @param array $data
     * @return array
     */
    public function validate(array $data): array
    {
        $errors = [];
        if(empty($data['login']) || empty($data['password'])){
            $errors['common'] = 'Логин и Пароль обязательны';
            return $errors;
        }
        if(mb_strlen($data['login']) < 3){
            $errors['login'] = 'Логин должен быть больше 3 символов';
        }
        if(mb_strlen($data['password']) < 6){
            $errors['password'] = 'Пароль должен быть больше 6 символов';
        }
        return $errors;
    }

}