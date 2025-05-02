document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.dismiss-btn').forEach(button => {
        button.addEventListener('click', function () {
            const notificationId = this.getAttribute('data-id');
            const buttonElement = this;

            fetch('notifications.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
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
