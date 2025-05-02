document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.dismiss-btn').forEach(button => {
        button.addEventListener('click', function () {
            // Retrieving the notification ID from the button's data-id attribute
            const notificationId = this.getAttribute('data-id');
            const buttonElement = this;
            // Sending a POST request to notifications.php to delete this notification
            fetch('notifications.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                // URL-encoded body containing action and the notification ID
                body: 'action=delete_notification&id=' + notificationId
            })
            .then(response => response.text())
            .then(result => {
                if (result === 'success') {
                    buttonElement.closest('.notification').remove();
                } else {
                    alert('Failed to dismiss notification.');
                }
            });
        });
    });
});
