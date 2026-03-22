<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Map Names to Slugs
$map = [
    'Espresso' => 'espresso',
    'Milk Based' => 'milk-based',
    'Cold Brew' => 'cold-brew',
    'Pastries' => 'pastries'
];

foreach ($map as $name => $slug) {
    echo "Updating products with category '$name' to '$slug'...\n";
    $mysqli->query("UPDATE products SET category = '$slug' WHERE category = '$name'");
    echo "Affected rows: " . $mysqli->affected_rows . "\n";
}

$mysqli->close();
echo "Migration complete.\n";
