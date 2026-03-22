<?php
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
$loader = require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/app/Config/Paths.php';
$config = new Config\Paths();
require_once $config->systemDirectory . '/bootstrap.php';

$db = \Config\Database::connect();
echo "Active Database: " . $db->getDatabase() . "\n";
