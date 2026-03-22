<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$result = $mysqli->query("SELECT id, name, slug, status FROM categories");
echo "ID | Name | Slug | Status\n";
echo "--------------------------\n";
while ($row = $result->fetch_assoc()) {
    echo "{$row['id']} | {$row['name']} | {$row['slug']} | {$row['status']}\n";
}

$mysqli->close();
