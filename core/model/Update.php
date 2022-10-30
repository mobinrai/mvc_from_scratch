<?php

namespace core\model;

use core\interfaces\IQueryString;

class Update implements IQueryString
{
    private array $conditions = [];
    private array $values = [];
    private string $table;
    public function __construct(string $table)
    {
        $this->table = $table;        
    }
    public function where(string ...$where): self
    {
        foreach ($where as $column) {
            $this->conditions[] = ":$column";
        }
        return $this;
    }
    public function set(string ...$values): self
    {
        foreach ($values as $value) {
            $this->values[] = "$value = :$value";
        }
        return $this;
    }
    public function __toString(): string
    {
        $conditions = ($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions));
        return 'UPDDATE ' .$this->table
                .' SET ' . implode(', ', $this->values)
                . $conditions;
    }
}