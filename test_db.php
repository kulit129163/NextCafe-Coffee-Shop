<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

echo "Standardizing 'Frappe' category in products table...\n";
$mysqli->query("UPDATE products SET category = 'frappe' WHERE category LIKE 'Frappe%' OR category LIKE 'frappe%'");
echo "Affected rows in products: " . $mysqli->affected_rows . "\n";

$result = $mysqli->query("SELECT id, name, category, status FROM products WHERE category = 'frappe'");
echo "\nProducts in 'frappe' category:\n";
while ($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']} | Name: {$row['name']} | Status: {$row['status']}\n";
}

$mysqli->close();
