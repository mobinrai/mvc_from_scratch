<?php

namespace app\migrations;

use core\traits\DatabaseTraits;

class m0003_email_verification
{
    use DatabaseTraits;
    public function up(): void
    {           
        $sql = 'CREATE TABLE `email_verifications` (
            `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` bigint(20) unsigned NOT NULL,
            `verification_code` int(11) NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            `deleted_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE
          ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci';
        $this->dbExec($sql);
        
    }
    public function down(): void
    {
        $sql = 'DROP Table email_verifications';
        $this->dbExec($sql);
    }
}