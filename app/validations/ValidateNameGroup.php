<?php

namespace app\validations;

class ValidateNameGroup
{
    /**
     * input validate name new group
     * @param string $name
     * @return array
     */
    public function validate(string $name): array
    {

        $errors = [];
        $name = trim($name);
        if($name === ''){
            $errors[] = 'Имя группы обязательно';
        }
        if(mb_strlen($name) < 3){
            $errors[] = 'Имя группы должно быть больше 3 символов';
        }
        if(mb_strlen($name) > 255){
            $errors[] = 'Имя группы должно быть меньше 255 символов';
        }
        return $errors;
    }

}