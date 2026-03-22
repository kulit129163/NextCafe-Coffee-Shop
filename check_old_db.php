<?php
$mysqli = new mysqli("localhost", "root", "", "");
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (!$mysqli->select_db("nextcafe_db")) {
    die("Database nextcafe_db not found.");
}

$result = $mysqli->query("SELECT id, name, category, status FROM products");
echo "Products in nextcafe_db:\n";
while ($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']} | Name: {$row['name']} | Category: '{$row['category']}' | Status: {$row['status']}\n";
}

$mysqli->close();
