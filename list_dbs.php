<?php
$mysqli = new mysqli("localhost", "root", "", "");

$result = $mysqli->query("SHOW DATABASES");
echo "Databases found:\n";
while ($row = $result->fetch_row()) {
    echo $row[0] . "\n";
}

$mysqli->close();
