<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$result = $mysqli->query("DESCRIBE cart");
echo "Column | Type | Null | Key | Default | Extra\n";
echo "----------------------------------------------\n";
while ($row = $result->fetch_assoc()) {
    echo "{$row['Field']} | {$row['Type']} | {$row['Null']} | {$row['Key']} | {$row['Default']} | {$row['Extra']}\n";
}

$mysqli->close();
