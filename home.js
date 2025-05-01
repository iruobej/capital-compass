function filterTransactions() {
    const input = document.getElementById("txSearch");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("txTable");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        const row = tr[i];
        const td = row.getElementsByTagName("td");
        let match = false;

        for (let j = 0; j < td.length; j++) {
            if (td[j] && td[j].innerText.toLowerCase().indexOf(filter) > -1) {
                match = true;
                break;
            }
        }

        row.style.display = match ? "" : "none";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('add-goal-btn').addEventListener('click', function () {
        const container = document.getElementById('new-goal-container');
        const div = document.createElement('div');
        div.innerHTML = `
            <input type="text" id="new-goal-input" placeholder="Enter goal description" />
            <button id="save-new-goal">Save</button>
        `;
        container.innerHTML = ''; // prevent multiple inputs at once
        container.appendChild(div);

        document.getElementById('save-new-goal').addEventListener('click', function () {
            const description = document.getElementById('new-goal-input').value;

            fetch('update_profile.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    field: 'add_goal',
                    description: description
                })
            })
            .then(res => res.text()) // <- change to .text() to capture broken JSON
            .then(text => {
                console.log('Raw response:', text); // Show real error
                try {
                    const data = JSON.parse(text);
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to add goal');
                    }
                } catch (e) {
                    console.error('Invalid JSON:', e);
                    alert('Server error (invalid response)');
                }
            });
        });
    });
    // Handle goal editing
    document.querySelectorAll('.edit-btn').forEach(function (editBtn) {
        editBtn.addEventListener('click', function () {
            const parent = this.parentElement;
            parent.querySelector('.display-value').style.display = 'none';
            parent.querySelector('.edit-inputs').style.display = 'inline';
            this.style.display = 'none';
            parent.querySelector('.save-btn').style.display = 'inline';
        });
    });

    // Handle goal saving
    document.querySelectorAll('.save-btn').forEach(function (saveBtn) {
        saveBtn.addEventListener('click', function () {
            const parent = this.parentElement;
            const goal_id = parent.dataset.goalId;
            const value = parent.querySelector('.edit-input').value;

            fetch('update_profile.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    field: 'goal_update',
                    goal_id: goal_id,
                    value: value
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log('Goal response:', data); // add this line
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to add goal');
                }
            });
        });
    });
});