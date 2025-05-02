<?php
// notifications_lib.php
// Provides functions to create and delete notifications for users.

// Ensure a session is active, since notifications may rely on session data
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Inserting a new notification into the database.
 *
 * param int    $userId  ID of the user who will receive the notification.
 * param string $title   Brief title of the notification.
 * param string $message Detailed message content.
 */
function createNotification($userId, $title, $message) {
    $stmt = $pdo->prepare("
        INSERT INTO notifications (user_id, title, message, created_at) 
        VALUES (:user_id, :title, :message, NOW())
    ");

    $stmt->execute([
        ':user_id' => $userId,
        ':title'   => $title,
        ':message' => $message
    ]);
}

/**
 * Deleting an existing notification.
 *
 * param PDO $pdo  PDO database connection instance.
 * param int $id   The primary key of the notification record to delete.
 * return bool     True if deletion was successful, false on error.
 */
function deleteNotification(PDO $pdo, int $id): bool {
    try {
        $stmt = $pdo->prepare("DELETE FROM notifications WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        // You can log the error if needed
        return false;
    }
}
?>
