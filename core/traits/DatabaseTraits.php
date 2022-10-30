<?php

namespace core\traits;

use core\Database;
use core\exceptions\DatabaseException;
use PDO;
use PDOException;
use PDOStatement;

trait DatabaseTraits
{
    private $statement;
    private Database $db;
    public function dbPrepare(string $sql): PDOStatement
    {
        $this->statement = $this->getDbConnection()->prepare($sql);
        return $this->statement;
    }
    /**
     * If no variables are going to be used in the query,
     * you can use the PDO::query() method
     * @param [string] $sql
     * @param [string] $option
     * @return array
     */
    public function dbQuery(string $sql, string $option=''): array
    {
        $result = $this->getDbConnection()->query($sql);
        return $option !== '' ? $result->fetchAll($option) : $result->fetchAll();
    }

    public function dbExecute(string $sql, array $params=[]): PDOStatement
    {
        $statement = $this->dbPrepare($sql);
        $statement->execute($params);
        return $statement;
    }
    public function dbExec(string $sql)
    {
        try
        {
            return $this->getDbConnection()->exec($sql);
        }
        catch(PDOException $exc)
        {
            echo $exc->getMessage();
        }        
    }
    public function getDbConnection(): PDO
    {
        $this->db = Database::init();
        return $this->db->getConnection();
    }

}
