<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

echo "Renaming category ID 1 (Espresso) to Frappe...\n";
$mysqli->query("UPDATE categories SET name = 'Frappe', slug = 'frappe' WHERE id = 1");
echo "Affected rows in categories: " . $mysqli->affected_rows . "\n";

echo "Updating all products that were 'espresso' to 'frappe'...\n";
$mysqli->query("UPDATE products SET category = 'frappe' WHERE category = 'espresso'");
echo "Affected rows in products: " . $mysqli->affected_rows . "\n";

$mysqli->close();
echo "Update complete.\n";
