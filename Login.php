<?php

namespace app\models;

use yii\base\Model;

class Login extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return[
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute)
    {
        $user = $this->getUser();

        if(!$this->hasErrors()){
            if(!$user || !$user->validatePassword($this->password)){
                $this->addError($attribute, 'Пароль или email введены неверно!');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['email'=>$this->email]);
    }
}