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
                type: 'add_goal',
                description: description
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Or re-render the goal list dynamically
            } else {
                alert('Failed to add goal');
            }
        });
    });
});