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
        container.innerHTML = '';
        container.appendChild(div);

        document.getElementById('save-new-goal').addEventListener('click', function () {
            const description = document.getElementById('new-goal-input').value;

            fetch('update_profile.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                credentials: 'include',
                body: JSON.stringify({
                    field: 'add_goal',
                    description: description
                })
            })
            .then(res => res.json())
            .then(data => {
                const goalsBoxes = document.querySelectorAll('.box');
                let goalsBox = null;
                goalsBoxes.forEach(box => {
                    if (box.querySelector('h2')?.textContent.includes('Financial Goals')) {
                        goalsBox = box;
                    }
                });

                if (data.success && data.goal && goalsBox) {
                    const contentWrapper = document.createElement('div');
                    contentWrapper.className = 'goal-content';
                    contentWrapper.style.display = 'flex';
                    contentWrapper.style.alignItems = 'center';
                    contentWrapper.style.gap = '10px';

                    contentWrapper.innerHTML = `
                        <span class="display-value">${data.goal.description}</span>
                        <span class="edit-inputs" style="display:none;">
                            <input type="text" class="edit-input" value="${data.goal.description}" />
                        </span>
                        <button class="edit-btn"><i class="fa-solid fa-pencil"></i></button>
                        <button class="delete-btn" data-goal-id="${data.goal.goal_id}"><i class="fa-solid fa-trash"></i></button>
                        <button class="save-btn" style="display:none;">Save</button>
                    `;
                    
                    goalDiv.appendChild(contentWrapper);
                    goalsBox.insertBefore(goalDiv, document.getElementById('add-goal-btn'));

                    goalDiv.querySelector('.edit-btn').addEventListener('click', function () {
                        goalDiv.querySelector('.display-value').style.display = 'none';
                        goalDiv.querySelector('.edit-inputs').style.display = 'inline';
                        this.style.display = 'none';
                        goalDiv.querySelector('.save-btn').style.display = 'inline';
                    });

                    goalDiv.querySelector('.save-btn').addEventListener('click', function () {
                        const newValue = goalDiv.querySelector('.edit-input').value;
                        fetch('update_profile.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            credentials: 'include',
                            body: JSON.stringify({
                                field: 'goal_update',
                                goal_id: data.goal.goal_id,
                                value: newValue
                            })
                        })
                        .then(res => res.json())
                        .then(update => {
                            if (update.success) {
                                goalDiv.querySelector('.display-value').textContent = newValue;
                            } else {
                                alert('Failed to update goal');
                            }

                            goalDiv.querySelector('.display-value').style.display = 'inline';
                            goalDiv.querySelector('.edit-inputs').style.display = 'none';
                            goalDiv.querySelector('.edit-btn').style.display = 'inline';
                            goalDiv.querySelector('.save-btn').style.display = 'none';
                        });
                    });

                    goalDiv.querySelector('.delete-btn').addEventListener('click', function () {
                        if (!confirm("Are you sure you want to delete this goal?")) return;

                        fetch('update_profile.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            credentials: 'include',
                            body: JSON.stringify({
                                field: 'delete_goal',
                                goal_id: data.goal.goal_id
                            })
                        })
                        .then(res => res.json())
                        .then(del => {
                            if (del.success) {
                                this.closest('.goal-item').remove();
                            } else {
                                alert('Failed to delete goal');
                            }
                        });
                    });

                    document.getElementById('new-goal-container').innerHTML = '';
                } else {
                    alert('Failed to add goal');
                }
            });
        });
    });

    document.querySelectorAll('.edit-btn').forEach(function (editBtn) {
        editBtn.addEventListener('click', function () {
            const parent = this.parentElement;
            parent.querySelector('.display-value').style.display = 'none';
            parent.querySelector('.edit-inputs').style.display = 'inline';
            this.style.display = 'none';
            parent.querySelector('.save-btn').style.display = 'inline';
        });
    });

    document.querySelectorAll('.save-btn').forEach(function (saveBtn) {
        saveBtn.addEventListener('click', function () {
            const parent = this.parentElement;
            const goal_id = parent.dataset.goalId;
            const value = parent.querySelector('.edit-input').value;

            fetch('update_profile.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                credentials: 'include',
                body: JSON.stringify({
                    field: 'goal_update',
                    goal_id: goal_id,
                    value: value
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    parent.querySelector('.display-value').textContent = value;
                } else {
                    alert('Failed to update goal');
                }

                parent.querySelector('.display-value').style.display = 'inline';
                parent.querySelector('.edit-inputs').style.display = 'none';
                parent.querySelector('.edit-btn').style.display = 'inline';
                this.style.display = 'none';
            });
        });
    });

    document.querySelectorAll('.delete-btn').forEach(function (deleteBtn) {
        deleteBtn.addEventListener('click', function () {
            const goalId = this.dataset.goalId;
            const goalDiv = this.closest('.goal-item');

            if (!confirm("Are you sure you want to delete this goal?")) return;

            fetch('update_profile.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                credentials: 'include',
                body: JSON.stringify({
                    field: 'delete_goal',
                    goal_id: goalId
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    goalDiv.remove();
                } else {
                    alert('Failed to delete goal');
                }
            });
        });
    });
});