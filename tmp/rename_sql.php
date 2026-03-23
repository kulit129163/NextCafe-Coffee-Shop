<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

if ($mysqli->query("ALTER TABLE reviews CHANGE review_text comment TEXT NULL")) {
    echo "Column renamed successfully.\n";
} else {
    echo "Error renaming column: " . $mysqli->error . "\n";
}

$mysqli->close();
