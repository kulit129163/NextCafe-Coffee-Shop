<?php
$mysqli = new mysqli("localhost", "root", "", "nextcafe_ecomms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$email = "sirvonmagbitang@gmail.com";
$password = "sirvonmagbitang0528";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$result = $mysqli->query("SELECT * FROM users WHERE email = '$email'");

if ($result && $result->num_rows > 0) {
    // User exists, update role and password
    $mysqli->query("UPDATE users SET role = 'admin', password = '$hashedPassword' WHERE email = '$email'");
    echo "User found. Updated role to admin and reset password.\n";
} else {
    // User does not exist, insert
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, role, first_name, last_name) VALUES (?, ?, ?, 'admin', 'Sir', 'Von')");
    $username = "sirvon";
    $stmt->bind_param("sss", $username, $email, $hashedPassword);
    $stmt->execute();
    echo "User created as admin.\n";
}

$mysqli->close();
