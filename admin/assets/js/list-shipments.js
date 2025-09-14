document.addEventListener("DOMContentLoaded", function () {
    const apiUrl = "/api/list-shipments"; // adjust path if needed
    const tableBody = document.querySelector("#shipmentsTable tbody");

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

            result.data.forEach(item => {
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td>${item.tracking_number || ""}</td>
                    <td>${item.booking_date || ""}</td>                  
                    <td>${item.carrier || ""}</td>  
                    <td>${item.internal_lrn || ""}</td>                    
                    <td>${item.consignor_name || ""}, ${item.consignor_address || ""}<br/>
                        Ph: ${item.consignor_phone || ""}                        
                    </td>
                    <td>${item.consignee_name || ""},  ${item.consignee_address || ""}<br/>
                        Ph: ${item.consignee_phone || ""}
                    </td>
                    <td>${item.history_date || ""}</td>
                    <td>${item.status || ""}</td>`;

                tableBody.appendChild(row);
            });
        })
        .catch(err => {
            console.error("API error:", err);
            alert("Failed to load shipments.");
        });
});
