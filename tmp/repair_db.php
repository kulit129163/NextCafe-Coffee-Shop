<?php
require 'c:\Users\Martin Ore\OneDrive - feutech.edu.ph\Documents\NextCafe-Coffee-Shop\vendor\autoload.php';
$app = require 'c:\Users\Martin Ore\OneDrive - feutech.edu.ph\Documents\NextCafe-Coffee-Shop\vendor\codeigniter4\framework\system\Test\bootstrap.php';
$db = \Config\Database::connect();
$forge = \Config\Database::forge();

$fields = $db->getFieldNames('reviews');
if (!in_array('comment', $fields)) {
    echo "Column 'comment' is missing. Adding it...\n";
    $forge->addColumn('reviews', [
        'comment' => ['type' => 'TEXT', 'null' => true]
    ]);
    echo "Column added.\n";
} else {
    echo "Column 'comment' already exists.\n";
}
