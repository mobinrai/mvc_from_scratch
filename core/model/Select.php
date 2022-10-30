<?php

namespace core\model;


class Select
{
    private array $fields = [];
    private array $conditions = [];
    private array $from = [];
    private array $orderBy = [];
    private array $innerJoin = [];
    private array $leftJoin = [];
    private int $limit; 
    public function __construct(array $select)
    {
        $this->fields = $select;
    }
    public function select(string ...$select): self
    {
        foreach($select as $args){
            $this->fields[] = $args;
        }
        return $this;
    }

    public function join(string $join='inner join', string ...$on): self
    {
        if($join!='inner join'){
            $this->leftJoin = [];
            foreach ($on as $arg) {
                $this->innerJoin[] = $arg;
            }
        }else{
            $this->innerJoin = [];
            foreach ($on as $arg) {
                $this->leftJoin[] = $arg;
            }
        }
        return $this;
    }
    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }
    public function where(string ...$where): self
    {
        foreach ($where as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }
    public function orderBy(string ...$orderBy): self
    {
        foreach ($orderBy as $arg) {
            $this->orderBy[] = $arg;
        }
        return $this;
    }
    public function from(string $table, ?string $alias = null): self
    {
        if ($alias === null) {
            $this->from[] = $table;
        } else {
            $this->from[] = "${table} AS ${alias}";
        }
        return $this;
    }
    public function __toString(): string
    {
        $where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
        $leftJoin = sizeof($this->innerJoin)>0 ? ' LEFT JOIN '. implode(' LEFT JOIN ', $this->leftJoin) : '';
        $innerJoin = sizeof($this->innerJoin)>0 ? ' INNER JOIN '. implode(' LEFT JOIN ', $this->innerJoin): '';
        $orderBy = sizeof($this->orderBy)>0 ? ' ORDER BY '. implode(',', $this->orderBy):'';
        $limit = isset($this->limit) ? ' limit ' .$this->limit:'';
        return 'SELECT ' . implode(', ', $this->fields)
            . ' FROM ' . implode(', ', $this->from)
            . $leftJoin
            . $innerJoin
            . $where
            . $orderBy
            . $limit;
    }
}