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
                field: parent.textContent.split(":")[0].trim().toLowerCase().replace(/\s/g, "_"),
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
