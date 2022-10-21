<?php

namespace core;

use PDO;
use core\traits\ErrorsTraits;
use PDOException;

class Database
{
    use ErrorsTraits;
    protected $connection = null;
    protected $statement;
    public function __construct()
    {
        try
        {
            $dotEnv = new DotEnv(ROOTH_PATH.'/.env');
            $dotEnv->readFile();
            $this->connection = new PDO($dotEnv->getDsn(), $_ENV['DB_USER'], $_ENV['DB_PASS'], [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
        }
        catch(PDOException $pEx)
        {
            $this->errorMessage("Could not establish connection with database.");
        }
    }
    public function getConnection()
    {
        return $this->connection;
    }
}