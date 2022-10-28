<?php

namespace app\models;
use core\model\BaseModel;

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
        {

        }
        return true;
    }
}