<?php

namespace core;

use core\exceptions\DatabaseException;
use PDO;
/**
 * SingleTon class for database connection
 */
final class Database
{
    public static $instance = null;
    private PDO $connection;

    private function __clone()
    {}
    public function __wakeup()
    {}
    private function __construct()
    {
        try {
            $dotEnv = new DotEnv(ROOTH_PATH.'/.env');
            $dotEnv->readFile();
            $this->connection = new PDO($this->getDsn(), $_ENV['DB_USER'], $_ENV['DB_PASS'], [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
        }
        catch(\Exception $pEx) {
            throw new DatabaseException();
        }
    }
    public static function init(): object
    {
        return self::$instance ?? new self;
    }
    public function getConnection(): PDO
    {
        return $this->connection;
    }
    private function getDsn(): string
    {
        return "mysql:host=".$_ENV['DB_HOST'].";port=".$_ENV['DB_PORT'].";dbname=".$_ENV['DB_NAME'];
    }
}