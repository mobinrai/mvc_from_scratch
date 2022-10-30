<?php

namespace core\model;

class QueryBuilder
{
    public static function select(string ...$select): Select
    {
        return new Select($select);
    }
    public static function insert(string $table): Insert
    {
        return new Insert($table);
    }
    public static function update(string $table): Update
    {
        return new Update($table);
    }
    public static function delete(string $table): Delete
    {
        return new Delete($table);
    }
}