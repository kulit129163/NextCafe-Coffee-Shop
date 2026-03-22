<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");
if ($mysqli->connect_errno) { die("Connection failed: " . $mysqli->connect_error); }

// Add status column to users table if missing
$result = $mysqli->query("SHOW COLUMNS FROM `users` LIKE 'status'");
if ($result->num_rows == 0) {
    $mysqli->query("ALTER TABLE `users` ADD COLUMN `status` ENUM('active','inactive') NOT NULL DEFAULT 'active' AFTER `role`");
    echo $mysqli->error ? "Error: " . $mysqli->error : "Added 'status' column to users table.\n";
} else {
    echo "Column 'status' already exists in users table.\n";
}

$mysqli->close();
echo "Done.\n";
