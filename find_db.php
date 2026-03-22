<?php
$mysqli = @new mysqli("localhost", "root", "", "");
$res = $mysqli->query("SHOW DATABASES");
while ($row = $res->fetch_row()) {
    $db = $row[0];
    if (in_array($db, ['information_schema', 'mysql', 'performance_schema', 'phpmyadmin'])) continue;
    
    $mysqli->select_db($db);
    $check = $mysqli->query("SELECT id, name, category FROM products WHERE name LIKE '%Cappuccino%'");
    if ($check && $check->num_rows > 0) {
        $p = $check->fetch_assoc();
        echo "FOUND 'Cappuccino' in database: $db (ID: {$p['id']}, Category: {$p['category']})\n";
    }
}
$mysqli->close();
