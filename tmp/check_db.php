<?php
require 'c:\Users\Martin Ore\OneDrive - feutech.edu.ph\Documents\NextCafe-Coffee-Shop\vendor\autoload.php';
$app = require 'c:\Users\Martin Ore\OneDrive - feutech.edu.ph\Documents\NextCafe-Coffee-Shop\vendor\codeigniter4\framework\system\Test\bootstrap.php';
$db = \Config\Database::connect();
$query = $db->query("DESCRIBE reviews");
foreach($query->getResult() as $row) {
    echo $row->Field . " (" . $row->Type . ")\n";
}
