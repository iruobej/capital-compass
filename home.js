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