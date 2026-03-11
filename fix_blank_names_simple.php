<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'nextcafe_ecomms';

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "--- FIXING BLANK NAMES ---\n";

$result = $conn->query("SELECT id, username, name FROM users WHERE name = '' OR name IS NULL");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $username = $row['username'];
        
        echo "Fixing user: {$username}... ";
        
        $stmt = $conn->prepare("UPDATE users SET name = ?, updated_at = NOW() WHERE id = ?");
        $stmt->bind_param("si", $username, $id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "Done (set name to username).\n";
        } else {
            echo "Failed or no change.\n";
        }
        $stmt->close();
    }
} else {
    echo "No users found with blank names.\n";
}

echo "\n--- VERIFICATION ---\n";
$result = $conn->query("SELECT id, username, name FROM users");
while($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']} | Username: {$row['username']} | Name: " . ($row['name'] ?: 'BLANK' ) . "\n";
}

$conn->close();
