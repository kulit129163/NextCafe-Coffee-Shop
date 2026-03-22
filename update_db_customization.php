<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

echo "Adding 'options' column to cart table...\n";
$mysqli->query("ALTER TABLE cart ADD COLUMN options TEXT NULL AFTER quantity");
echo "Result: " . ($mysqli->error ? $mysqli->error : "Success") . "\n";

echo "Adding 'options' column to order_items table...\n";
$mysqli->query("ALTER TABLE order_items ADD COLUMN options TEXT NULL AFTER quantity");
echo "Result: " . ($mysqli->error ? $mysqli->error : "Success") . "\n";

$mysqli->close();
echo "Database update complete.\n";
