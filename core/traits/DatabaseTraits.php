<?php

namespace core\traits;

use core\Database;
use PDOException;

trait DatabaseTraits
{
    private $statement;
    private Database $db;
    public function dbPrepare(string $sql, $params = [])
    {
        $this->statement = $this->getDbConnection()->prepare($sql);
        return $this->statement;
    }
    /**
     * If no variables are going to be used in the query,
     * you can use the PDO::query() method
     *
     * @param [string] $sql
     * @param [string] $option
     * @return array
     */
    public function dbQuery(string $sql,string $option=''): array
    {
        $result = $this->getDbConnection()->query($sql);
        return $option !== '' ? $result->fetchAll($option) : $result->fetchAll();
    }
    public function dbExec(string $sql)
    {
        try
        {
            $this->getDbConnection()->exec($sql);
        }
        catch(PDOException $exc)
        {
            echo $exc->getMessage();
        }        
    }
    public function getDbConnection(): object{
        $this->db = new Database();
        return $this->db->connection;
    }

}
