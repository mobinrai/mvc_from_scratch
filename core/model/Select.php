<?php

namespace core\model;


class Select
{
    private array $fields = [];
    private array $conditions = [];
    private array $from = [];
    private $joinTable;
    private array $orderBy = [];
    private array $innerJoin = [];
    private array $leftJoin = [];
    private array $rightJoin = [];
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

    public function join(string $join, $joinTable, string ...$on): self
    {
        
        if($join=='inner join')
        {
            $this->innerJoin[] = ' '.strtoupper($join). $joinTable.' ON '. implode(" AND ", $on);
        }
        else if($join=='right join')
        {
            $this->rightJoin[] = ' '.strtoupper($join).' '. $joinTable.' ON '. implode(" AND ", $on);
        }
        else{
            $this->leftJoin[] = ' '.strtoupper($join).' '. $joinTable.' ON '. implode(" AND ", $on);
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
        $leftJoin = sizeof($this->leftJoin)>0 ? implode(',', $this->leftJoin) : '';
        $innerJoin = sizeof($this->innerJoin)>0 ? ' INNER JOIN '.$this->joinTable. ' ON '. implode(' INNER JOIN ', $this->innerJoin): '';
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