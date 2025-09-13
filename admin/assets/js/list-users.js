document.addEventListener("DOMContentLoaded", function () {
    const apiUrl = "/api/list-users"; // adjust path if needed
    const tableBody = document.querySelector("#usersTable tbody");

    // Fetch shipments from API
    fetch(apiUrl)
        .then(response => response.json())
        .then(result => {
            if (!result.success) {
                alert("Error: " + result.message);
                return;
            }

            tableBody.innerHTML = "";

            if (result.count === 0) {
                tableBody.innerHTML = "<tr><td colspan='16'>No shipments found</td></tr>";
                return;
            }

            result.data.forEach((item, i) => {
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td>${i + 1}.</td>
                    <td>${item.name || ""}</td>                  
                    <td>${item.email || ""}</td>  
                    <td>${item.username || ""}</td>
                    <td>${item.role || ""}</td>
                    <td>${item.status || ""}</td>                   
                    <td>Edit</td>`;

                tableBody.appendChild(row);
            });
        })
        .catch(err => {
            console.error("API error:", err);
            alert("Failed to load shipments.");
        });
});
