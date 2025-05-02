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
                credentials: 'include',
                body: JSON.stringify({
                    field: 'add_goal',
                    description: description
                }) 
            }) 
            .then(res => res.json()) 
            .then(data => { 
                if (data.success) {
                    location.reload(); 
                } else {
                    alert('Failed to add goal');
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
                credentials: 'include',
                body: JSON.stringify({
                    field: 'goal_update',
                    goal_id: goal_id,
                    value: value
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log('Goal response:', data); // add this line
                if (data.success && data.goal) {
                    const goalsBox = document.querySelector('.box h2:contains("Financial Goals")')?.parentElement;
                
                    const goalDiv = document.createElement('div');
                    goalDiv.className = 'goal-item';
                    goalDiv.setAttribute('data-goal-id', data.goal.goal_id);
                    goalDiv.setAttribute('data-field', 'description');
                
                    goalDiv.innerHTML = `
                        <span class="display-value">${data.goal.description}</span>
                        <span class="edit-inputs" style="display:none;">
                            <input type="text" class="edit-input" value="${data.goal.description}" />
                        </span>
                        <button class="edit-btn">Edit</button>
                        <button class="save-btn" style="display:none;">Save</button>
                    `;
                
                    // Insert new goal above the "+ Add Goal" button
                    const addBtn = document.getElementById('add-goal-btn');
                    goalsBox.insertBefore(goalDiv, addBtn);
                
                    // Re-attach edit/save event listeners
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
                
                    // Clear the new goal form
                    document.getElementById('new-goal-input').value = '';
                    document.getElementById('new-goal-container').innerHTML = '';
                } else {
                    alert('Failed to add goal');
                }                
            });
        });
    });
});