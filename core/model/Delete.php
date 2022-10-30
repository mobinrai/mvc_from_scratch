<?php

namespace core\model;
use core\interfaces\IQueryString;

class Delete implements IQueryString
{
    private string $table = '';
    private array $conditions = [];
    public function __construct(string $table)
    {
        $this->table = $table;        
    }
    public function where(string ...$columns): self
    {
        foreach ($columns as $column) {
            $this->conditions[] = $column;
        }
        return $this;
    }
    public function __toString(): string
    {
        $conditions = implode(' AND ' , $this->conditions);
        return "DELETE FROM ".$this->table. " WHERE ". $conditions;
    }
}