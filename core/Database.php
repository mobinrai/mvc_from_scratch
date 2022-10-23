<?php

namespace core;

use PDO;
use core\traits\ErrorsTraits;
use PDOException;

class Database
{
    use ErrorsTraits;
    public PDO $connection;
    protected $statement;
    public function __construct()
    {
        try
        {
            $dotEnv = new DotEnv(ROOTH_PATH.'/.env');
            $dotEnv->readFile();
            $this->connection = new PDO($this->getDsn(), $_ENV['DB_USER'], $_ENV['DB_PASS'], [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
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
    public function getDsn(): string
    {
        return "mysql:host=".$_ENV['DB_HOST'].";port=".$_ENV['DB_PORT'].";dbname=".$_ENV['DB_NAME'];
    }
}