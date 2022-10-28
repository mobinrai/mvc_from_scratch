<?php

namespace core;

use PDO;
use core\traits\ErrorsTraits;
use PDOException;
/**
 * SingleTon class for database connection
 */
final class Database
{
    use ErrorsTraits;
    public static $instance = null;
    private PDO $connection;

    private function __clone(): void
    {}
    private function __wakeup()
    {}
    private function __construct()
    {
        try {
            $dotEnv = new DotEnv(ROOTH_PATH.'/.env');
            $dotEnv->readFile();
            $this->connection = new PDO($this->getDsn(), $_ENV['DB_USER'], $_ENV['DB_PASS'], [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
        }
        catch(PDOException $pEx) {
            $this->errorMessage("Could not establish connection with database.");
        }
    }
    public static function init(): static
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