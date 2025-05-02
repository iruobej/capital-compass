<?php
session_start();
require_once 'config.php';

// Get JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Sanity check
if (!isset($_SESSION['user_id'], $data['topic'], $data['score'], $data['time_taken'], $data['pass_fail'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
    exit();
}

$user_id = $_SESSION['user_id'];
$topic = $data['topic'];
$score = $data['score'];
$time_taken = $data['time_taken'];
$pass_fail = $data['pass_fail'];

// Get or insert topic into quizzes table
$stmt = $conn->prepare("SELECT quiz_id FROM quizzes WHERE topic = :topic");
$stmt->execute(['topic' => $topic]);
$quiz = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$quiz) {
    $stmt = $conn->prepare("INSERT INTO quizzes (topic) VALUES (:topic) RETURNING quiz_id");
    $stmt->execute(['topic' => $topic]);
    $quiz_id = $stmt->fetchColumn();
} else {
    $quiz_id = $quiz['quiz_id'];
}

// Insert quiz attempt
$stmt = $conn->prepare("
    INSERT INTO quiz_attempts (user_id, quiz_id, score, time_taken, pass_fail)
    VALUES (:user_id, :quiz_id, :score, :time_taken, :pass_fail)
");

$stmt->execute([
    'user_id' => $user_id,
    'quiz_id' => $quiz_id,
    'score' => $score,
    'time_taken' => $time_taken,
    'pass_fail' => $pass_fail
]);

echo json_encode(['success' => true]);
exit();
?>
