<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
