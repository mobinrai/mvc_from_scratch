<?php

namespace app\models;

use core\Application;
use core\model\BaseModel;
use core\Validation;

class User extends BaseModel
{
    private string $tableName = 'users';
    protected array $fields = ['user_name', 'email', 'password'];
    public function tableName(): string
    {
        return $this->tableName;
    }
    public function save(): bool
    {
        if(parent::save())
        {}
        return true;
    }
    public function login():bool
    {
        $email = $this->__get('email');
        $password = $this->__get('password');
        $query = self::select('*')
                    ->from($this->tableName())
                    ->where('email = :email');
        $result = $this->dbExecute($query, ['email' => $email]);

        $user = $result->fetchObject(self::class);
        if(!$user)
        {
            Validation::$errorMessages['email'] = 'User with this email does not exists';
            return false;
        }
        if (!password_verify($password, $user->password)) {
            Validation::$errorMessages['password'] = 'Password is incorrect';
            return false;
        }
        return Application::$app->userLogin($user);
    }
}