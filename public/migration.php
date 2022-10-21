<?php

/**
 * Entry point for project
 */

include_once '../vendor/autoload.php';

define('ROOTH_PATH', dirname(__DIR__));

use core\Migration;

$migration = new Migration();

$migration->runMigrations();
