<?php
//Handling sensitive information i.e. the password in this external file
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    die("Not logged in");
}

$username = $_SESSION['username'];

$current = $_POST['current_password'] ?? '';
$new = $_POST['new_password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if (!$current || !$new || !$confirm) {
    die("Please fill in all fields.");
}

if ($new !== $confirm) {
    die("New passwords do not match.");
}

// Fetching user's current password hash from DB
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($current, $user['password'])) {
    die("Incorrect current password.");
}

// Hashing new password and updating DB
$newHash = password_hash($new, PASSWORD_DEFAULT);
$update = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
$update->execute([$newHash, $username]);

echo "Password updated successfully!";
