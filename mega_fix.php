<?php
$dbs = ['nextcafe_db', 'nextcafe_ecomms', 'testcafe_db'];
$map = [
    'Espresso' => 'espresso',
    'Milk Based' => 'milk-based',
    'Cold Brew' => 'cold-brew',
    'Pastries' => 'pastries',
    'Frappe' => 'frappe'
];

foreach ($dbs as $db) {
    echo "--- Checking database: $db ---\n";
    $mysqli = @new mysqli("localhost", "root", "", $db);
    if ($mysqli->connect_errno) {
        echo "Could not connect to $db: " . $mysqli->connect_error . "\n";
        continue;
    }

    foreach ($map as $name => $slug) {
        echo "Updating products in $db with category '$name' to '$slug'...\n";
        $mysqli->query("UPDATE products SET category = '$slug' WHERE category = '$name'");
        echo "Affected rows: " . $mysqli->affected_rows . "\n";
    }
    
    // Also check for any products with 'Espresso' in the name and NO category, assign them to 'espresso'
    $mysqli->query("UPDATE products SET category = 'espresso' WHERE name LIKE '%Espresso%' AND (category = '' OR category IS NULL)");
    if ($mysqli->affected_rows > 0) {
        echo "Auto-assigned " . $mysqli->affected_rows . " products to 'espresso' based on name.\n";
    }

    $mysqli->close();
}
echo "All migrations complete.\n";
