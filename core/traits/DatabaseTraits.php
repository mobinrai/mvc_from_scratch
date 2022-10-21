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

    public function dbExecute(string $sql, $params=[])
    {
        try{
            $prepare = $this->dbPrepare($sql, $params);
            return $prepare->execute();
        }
        catch(PDOException $exc)
        {
            echo $exc->getMessage();
        }
        
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
    public function getDbConnection(){
        $this->db= new Database();
        return $this->db->getConnection();
    }

}
