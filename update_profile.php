<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
session_start();
include 'config.php';
require_once 'notifications.php'; 

$data = json_decode(file_get_contents('php://input'), true);

$field = $data['field'] ?? '';
$value = $data['value'] ?? '';
$success = false;
$error = null;
$message = null;

// Make sure user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

$current_username = $_SESSION['username'];
$userId = $_SESSION['user_id'];

try {
    switch ($field) {
        case 'full_name':
            $first = trim($data['first_name'] ?? '');
            $last = trim($data['last_name'] ?? '');

            if ($first && $last) {
                $_SESSION['firstname'] = $first;
                $_SESSION['lastname'] = $last;

                $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ? WHERE username = ?");
                $success = $stmt->execute([$first, $last, $current_username]);
                $fullName = "$first $last";
                $message = "Your full name has been changed to $fullName.";
            } else {
                $error = "First or last name missing.";
            }
            break;

        case 'username':
            $new_username = trim($value);
            if ($new_username) {
                $stmt = $conn->prepare("UPDATE users SET username = ? WHERE username = ?");
                if ($stmt->execute([$new_username, $current_username])) {
                    $_SESSION['username'] = $new_username;
                    $message = "Your username has been changed to $new_username.";
                    $success = true;
                }
            } else {
                $error = "Username cannot be empty.";
            }
            break;

        case 'email':
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['email'] = $value;
                $stmt = $conn->prepare("UPDATE users SET email = ? WHERE username = ?");
                $message = "Your email address has been updated.";
                $success = $stmt->execute([$value, $current_username]);
            } else {
                $error = "Invalid email address.";
            }
            break;

        case 'budget':
            $budget_val = intval($value);
            if ($budget_val >= 0) {
                $_SESSION['budget_alert'] = $budget_val;
                $stmt = $conn->prepare("UPDATE users SET budget_alert = ? WHERE username = ?");
                $message = "Your budget alert has been updated to £$budget_val.";
                $success = $stmt->execute([$budget_val, $current_username]);
            } else {
                $error = "Budget must be a positive number.";
            }
            break;

        case 'goal_update':
            $goal_id = $data['goal_id'] ?? null;
            if ($goal_id && $value) {
                $stmt = $conn->prepare("UPDATE goals SET description = ? WHERE goal_id = ? AND user_id = ?");
                $success = $stmt->execute([$value, $goal_id, $userId]);
                $message = "Goal #$goal_id updated to: \"$value\".";
            } else {
                $error = "Missing goal ID or new description.";
            }
            break;

        case 'add_goal':
            $description = trim($data['description'] ?? '');
            if ($description) {
                $stmt = $conn->prepare("INSERT INTO goals (user_id, description) VALUES (?, ?)");
                $success = $stmt->execute([$userId, $description]);
                $message = "New goal added: \"$description\".";
            } else {
                $error = "Goal description cannot be empty.";
            }
            break;

        default:
            $error = "Unknown field: $field";
            break;
    }

    if ($message && $success) {
        createNotification($userId, "Profile Updated", $message);
    }

    echo json_encode([
        'success' => $success,
        'error' => $success ? null : ($error ?? 'Database update failed')
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
