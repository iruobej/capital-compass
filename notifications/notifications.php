<?php
session_start();
include_once __DIR__ . '/../navbar.php';
require_once __DIR__ . '/../configuration/config.php';
require_once __DIR__ . '/notifications_lib.php';

$user_id = $_SESSION['user_id'];

// Fetching all notifications for this user, most recent first
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
    // Handling AJAX request to delete a notification
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
                <!-- Individual notification card -->
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