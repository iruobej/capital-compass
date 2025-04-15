<?php
session_start();
header('Content-Type: application/json');
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$field = $data['field'] ?? '';
$value = $data['value'] ?? '';
$success = false;
$error = null;

// Make sure user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

$current_username = $_SESSION['username'];

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
            } else {
                $error = "First or last name missing.";
            }
            break;

        case 'user_name':
            $new_username = trim($value);
            if ($new_username) {
                $stmt = $conn->prepare("UPDATE users SET username = ? WHERE username = ?");
                if ($stmt->execute([$new_username, $current_username])) {
                    $_SESSION['username'] = $new_username;
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
                $success = $stmt->execute([$budget_val, $current_username]);
            } else {
                $error = "Budget must be a positive number.";
            }
            break;

        default:
            $error = "Unknown field: $field";
            break;
    }

    // Debugging
    if (!$success && isset($error)) {
        echo json_encode(['success' => false, 'error' => $error]);
        exit;
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
