<?php

namespace app\models;

use core\Application;
use core\exceptions\DatabaseException;
use core\model\BaseModel;
use core\Validation;

class EmailVerify extends BaseModel
{
    private string $tableName = 'email_verifications';
    protected array $fields = ['user_id', 'verification_code'];

    public function tableName(): string
    {
        return $this->tableName;
    }
    public function save(): bool
    {
        if(!parent::save())
        {
            throw new DatabaseException("Could not add records in the database");
        }
        return true;
    }
}
