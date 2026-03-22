<?php
$mysqli = new mysqli("localhost", "root", "", "");
$dbs = ['nextcafe_db', 'nextcafe_ecomms', 'testcafe_db'];

foreach ($dbs as $db) {
    echo "Checking database: $db\n";
    if ($mysqli->select_db($db)) {
        $result = $mysqli->query("SELECT id, name, category, status FROM products");
        if ($result) {
            echo "ID | Name | Category | Status\n";
            while ($row = $result->fetch_assoc()) {
                echo "{$row['id']} | {$row['name']} | '{$row['category']}' | {$row['status']}\n";
            }
        } else {
            echo "Table 'products' not found in $db\n";
        }
    } else {
        echo "Database $db not found.\n";
    }
    echo "-----------------------------------\n";
}
$mysqli->close();
