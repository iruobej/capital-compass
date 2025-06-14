<?php
session_start();
require_once __DIR__ . '/../configuration/config.php';

$errors = [];
$success = '';

if (!isset($_SESSION['username'])) {
    $errors[] = "You must be logged in to change your password.";
} else {
    $username = $_SESSION['username'];
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Validation
        // all fields must be filled
        if (!$current || !$new || !$confirm) {
            $errors[] = "All fields are required.";
        // New passwords must match
        } elseif ($new !== $confirm) {
            $errors[] = "New passwords do not match.";
        // Enforcing a minimum length for security    
        } elseif (strlen($new) < 12) {
            $errors[] = "New password must be at least 12 characters long.";
        } else {
            // Checking if current password is correct
            $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($current, $user['password'])) {
                $errors[] = "Current password is incorrect.";
            } else {
                // Updating password
                $newHash = password_hash($new, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                if ($update->execute([$newHash, $username])) {
                    $success = "Password updated successfully!";
                    header("Location: /profile/profile.php");
                    exit();
                } else {
                    $errors[] = "Something went wrong. Try again.";
                }
            }
        }
    }
}
?>
