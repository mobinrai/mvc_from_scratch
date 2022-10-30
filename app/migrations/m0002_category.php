<?php

namespace app\migrations;

use core\traits\DatabaseTraits;

class m0002_category
{
    use DatabaseTraits;
    public function up(): void
    {           
        $sql = 'CREATE TABLE `categories` (
            `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `parent_id` int(11) NOT NULL DEFAULT 0,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            `deleted_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci';
        $this->dbExec($sql);
        
    }
    public function down(): void
    {
        $sql = 'DROP Table categories';
        $this->dbExec($sql);
    }
}