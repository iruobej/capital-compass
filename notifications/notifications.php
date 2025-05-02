<?php
session_start();
include '../navbar.php';
include '../configuration/config.php'; 
include 'notifications_lib.php';

$user_id = $_SESSION['user_id'] ?? 1; // fallback for testing

// Fetching notifications from database
$stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');
    </style>
</head>
<body>
    <h1 id="header" style="text-align: center;">Notifications</h1>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_notification') {
        $id = intval($_POST['id']);
        echo deleteNotification($pdo, $id) ? 'success' : 'error';
        exit;
    }

    ?>
    <div class="notifications">
        <?php if (empty($notifications)): ?>
            <p style="text-align:center;">You have no notifications at the moment.</p>
        <?php else: ?>
            <?php foreach ($notifications as $note): ?>
                <div class="notification">
                    <h3><?= htmlspecialchars($note['title']) ?></h3>
                    <p><?= htmlspecialchars($note['message']) ?></p>
                    <small><?= date('j M Y, g:i a', strtotime($note['created_at'])) ?></small>
                    <button class="dismiss-btn" data-id="<?php echo $note['id']; ?>">Dismiss</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<script src="notifications.js"></script>
</body>
</html>