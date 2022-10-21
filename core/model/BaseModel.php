<?php

namespace core\model;

abstract class BaseModel
{
    abstract public function tableName(): string;

    public static function save()
    {
        # code...
    }

}