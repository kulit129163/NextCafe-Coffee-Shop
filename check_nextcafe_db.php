<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_db");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$result = $mysqli->query("SELECT id, name, category, status FROM products");
echo "ID | Name | Category | Status\n";
echo "------------------------------\n";
while ($row = $result->fetch_assoc()) {
    echo "{$row['id']} | {$row['name']} | '{$row['category']}' | {$row['status']}\n";
}

$mysqli->close();
echo "\nQuery complete.\n";
