<?php

namespace app\models;

use core\Application;
use core\model\BaseModel;
use core\Validation;

class Category extends BaseModel
{
    private string $tableName = 'categories';
    protected array $fields = ['name', 'slug', 'parent_id'];
    public function tableName(): string
    {
        return $this->tableName;
    }
}