<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

if ($result = $mysqli->query("DESCRIBE reviews")) {
    while ($row = $result->fetch_row()) {
        echo $row[0] . "\n";
    }
    $result->free_result();
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();
