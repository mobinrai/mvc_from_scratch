<?php

namespace core\model;

use core\traits\DatabaseTraits;

abstract class BaseModel
{
    use DatabaseTraits;
    private array $data = [];

    protected bool $hasCreatedAndUpdatedAt = true;
    abstract public function tableName(): string;

    public function __construct()
    {
        if($this->hasCreatedAndUpdatedAt)
        {
            $this->addCreatedAndUpdateAt();
        }
        
    }
    public function __set($property, $value): void
    {
        $this->data[$property] = $value;
    }
    public function __get(string $name): string
    {
        return isset($this->data[$name])? $this->data[$name] : '';
    }
    public function save(): bool
    {
        $tableName = $this->tableName();
        $params = implode(',', array_map(fn($f)=>":$f",$this->fields));
        $fields = $this->seperateFieldsWithComma();
        $sql = "INSERT INTO $tableName($fields) VALUES($params)";
        $statement = $this->dbPrepare($sql);

        foreach ($this->fields as $attribute) {
            $value =  $this->__get($attribute);
            if($attribute === 'password'){
                $value = $this->passwordHash($value);
            }
            $statement->bindValue(":$attribute",$value);
        }
        if($statement->execute()){
            return true;
        }
        return false;
    }
    private function seperateFieldsWithComma(): string
    {
        return implode(',', $this->fields);
    }

    private function passwordHash($data): string
    {
        return password_hash($data, PASSWORD_DEFAULT);
    }

    private function addCreatedAndUpdateAt(): void
    {
        array_push($this->fields, 'created_at');
        array_push($this->fields, 'updated_at');
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

}