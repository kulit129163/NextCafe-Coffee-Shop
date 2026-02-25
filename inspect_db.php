<?php
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
$loader = require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/app/Config/Paths.php';
$config = new \Config\Paths();
require __DIR__ . '/vendor/codeigniter4/framework/system/bootstrap.php';

$db = \Config\Database::connect();

echo "--- PRODUCTS TABLE STRUCTURE ---\n";
$query = $db->query('DESCRIBE products');
foreach ($query->getResult() as $row) {
    echo "Field: {$row->Field} | Type: {$row->Type} | Null: {$row->Null} | Key: {$row->Key} \n";
}

echo "\n--- CURRENT PRODUCTS ---\n";
$query = $db->table('products')->get();
foreach ($query->getResult() as $row) {
    echo "ID: {$row->id} | Name: {$row->product_name} | Category: {$row->category} | Image: " . ($row->image_url ?? 'NONE') . "\n";
}
