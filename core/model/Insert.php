<?php

namespace core\model;

use core\interfaces\IQueryString;

class Insert implements IQueryString
{
    private array $columns = [];
    private array $values = [];
    private string $table;
    public function __construct(string $table)
    {
        $this->table = $table;
    }
    public function columns(array $columns): self
    {
        $this->columns = $columns;
        foreach ($columns as $column) {
            $this->values[] = ":$column";
        }
        return $this;
    }
    public function __toString(): string
    {
        return 'INSERT INTO ' .$this->table. ' (' . implode(',',$this->columns) . ') VALUES (' . implode(', ',$this->values) . ')';
    }
}