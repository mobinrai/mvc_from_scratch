<?php
/**
 * Entry point for project
 */

include_once '../vendor/autoload.php';

use core\Application;

define('ROOTH_PATH', dirname(__DIR__));

$app = new Application;

echo $app->run();

die();
?>