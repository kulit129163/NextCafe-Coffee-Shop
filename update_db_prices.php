<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

echo "Adding 'unit_price' column to cart table...\n";
$mysqli->query("ALTER TABLE cart ADD COLUMN unit_price DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER quantity");
echo "Result: " . ($mysqli->error ? $mysqli->error : "Success") . "\n";

echo "Adding 'unit_price' column to order_items table...\n";
$mysqli->query("ALTER TABLE order_items ADD COLUMN unit_price DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER quantity");
echo "Result: " . ($mysqli->error ? $mysqli->error : "Success") . "\n";

// Update existing prices based on products table
$mysqli->query("UPDATE cart c JOIN products p ON c.product_id = p.id SET c.unit_price = p.price WHERE c.unit_price = 0");
$mysqli->query("UPDATE order_items oi JOIN products p ON oi.product_id = p.id SET oi.unit_price = p.price WHERE oi.unit_price = 0");

$mysqli->close();
echo "Database update complete.\n";
