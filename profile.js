// For handling the user clicking on the 'edit' button
document.querySelectorAll('.edit-btn').forEach(function(editBtn) {
    editBtn.addEventListener('click', function() {
        const parent = this.parentElement;

        // Hiding the display value
        const displayValue = parent.querySelector('.display-value');
        if (displayValue) displayValue.style.display = 'none';

        // Showing the input(s)
        const inputContainer = parent.querySelector('.edit-inputs');
        if (inputContainer) {
            inputContainer.style.display = 'inline';
        } else {
            parent.querySelectorAll('.edit-input').forEach(input => input.style.display = 'inline');
        }

        // Toggle buttons
        this.style.display = 'none';
        const saveBtn = parent.querySelector('.save-btn');
        if (saveBtn) saveBtn.style.display = 'inline';
    });
});

// For saving the new values
document.querySelectorAll('.save-btn').forEach(function(saveBtn) {
    saveBtn.addEventListener('click', function() {
        const parent = this.parentElement;

        let payload = {};
        if (parent.querySelector('.first-name')) {
            payload = {
                field: 'full_name',
                first_name: parent.querySelector('.first-name').value,
                last_name: parent.querySelector('.last-name').value
            };
        } else {
            payload = {
                field: parent.dataset.field,
                value: parent.querySelector('.edit-input').value
            };
        }

        fetch('update_profile.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (payload.field === 'full_name') {
                    parent.querySelector('.display-value').textContent = `${payload.first_name} ${payload.last_name}`;
                } else {
                    parent.querySelector('.display-value').textContent = payload.value;
                }
            } else {
                alert('Failed to update');
            }

            parent.querySelector('.display-value').style.display = 'inline';
            if (parent.querySelector('.edit-inputs')) parent.querySelector('.edit-inputs').style.display = 'none';
            parent.querySelectorAll('.edit-input').forEach(input => input.style.display = 'none');
            parent.querySelector('.save-btn').style.display = 'none';
            parent.querySelector('.edit-btn').style.display = 'inline';
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const passwordError = urlParams.get('password_error');
    const passwordSuccess = urlParams.get('password_success');
    const errorDiv = document.getElementById('error-message');

    if (passwordError && errorDiv) {
        errorDiv.textContent = decodeURIComponent(passwordError);
    }

    if (passwordSuccess) {
        alert("Password updated successfully!");
    }
});
