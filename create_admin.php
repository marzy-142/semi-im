<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

$username = 'admin';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$role = 'admin';

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $username, $hashed_password, $role);
$stmt->execute();

echo "Admin user created successfully!";
?>
