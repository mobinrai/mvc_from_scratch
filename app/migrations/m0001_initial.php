<?php

namespace app\migrations;

use core\traits\DatabaseTraits;

class m0001_initial
{
    use DatabaseTraits;
    public function up(): void
    {           
        $sql = 'CREATE TABLE `users` (
                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `users_email_unique` (`email`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;';
        $this->dbExec($sql);
        
    }
    public function down(): void
    {
        $sql = 'DROP Table users';
        $this->dbExec($sql);
    }
}