<?php

namespace core;

use core\traits\DatabaseTraits;
use PDO;

final class Migration
{
    use DatabaseTraits;
    public static $instance = null;

    private function __construct()
    {
    }

    public static function init(): object
    {
        return self::$instance ?? new self;
    }
    public function runMigrations(): void
    {
        $this->createMigrationTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $allMigrations = $this->getAllMigrations();

        $toApplyMigrations = array_diff($allMigrations, $appliedMigrations);
        $migrationNamespace = 'app\migrations\\';
        $newMigrations = [];
        foreach($toApplyMigrations as $migration)
        {
            if(in_array($migration, ['', '.', '..']))
            {
                continue;
            }
            $fullClassName = $migrationNamespace.$migration;
            if(class_exists($fullClassName))
            {
                $this->createTable($fullClassName, $migration);
                $newMigrations[] = $migration;
            }
        }
        if(!empty($newMigrations))
        {
            $this->insertNewMigrations($newMigrations);
        }
        else{
            $this->logMessage('All migrations had already applied..');
        }
    }
    /**
     * creates table from migration's up function
     * @param string $fullClassName-namespace and file name 
     * @param string $migration--file name
     * @return void
     */
    private function createTable(string $fullClassName, string $migration): void
    {
        $this->logMessage('Applying migrations..');
        $className = new $fullClassName;
        $className->up();
        echo $migration.PHP_EOL;
        $this->logMessage('Applied migrations..');
    }
    /**
     * creates main migrations table in the database 
     * if `migrations` is not exists...
     * 
     * @return void
     */
    private function createMigrationTable(): void
    {
        $this->dbExec('CREATE TABLE `migrations` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `created_at` datetime DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    }
    /**
     * Gets all applied migration from migrations table
     * @return 
     */
    private function getAppliedMigrations(): array
    {
        return $this->dbQuery('SELECT migration FROM migrations', PDO::FETCH_COLUMN);  
    }
    /**
     * insert's new migrations file names in the database
     * @param array $newMigrations
     * @return void
     */
    private function insertNewMigrations(array $newMigrations=[]): void
    {
        $strMigrations = implode(",", array_map(fn($m)=>"('$m')", $newMigrations));
        $statement = $this->dbPrepare("INSERT INTO migrations(migration) VALUES $strMigrations");
        $statement->execute();
    }
    private function getAllMigrations(): array
    {
        $files=[];
        foreach(scandir(ROOTH_PATH.'/app/migrations') as $file)
        {
            $files [] = pathinfo($file, PATHINFO_FILENAME);
        }
        return $files;
    }
    private function logMessage(string $message): void
    {
        echo '['.date('Y-m-d H:i:s'). ']'. $message.PHP_EOL;
    }
}