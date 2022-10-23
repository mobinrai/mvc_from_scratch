<?php

namespace core\model;

use Stringable;

class Sql
{
    private array $columns = [];
    private array $from = [];
    private array $where = [];

    public function select(array $fields): Sql
    {
        $this->columns = $fields;
        return $this;
    }

    public function from(string $table, string $alias): Sql
    {
        $this->from[] = $table . ' AS ' . $alias;

        return $this;
    }

    public function where(string $condition): Sql
    {
        $this->where[] = $condition;

        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s',
            join(', ', $this->columns),
            join(', ', $this->from),
            join(' AND ', $this->where)
        );
    }
}