$(document).ready(function() {
    $('#frmBulkUpload').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        var fileInput = $('#formFile')[0];
        if (fileInput.files.length === 0) {
            alert('Please select a CSV file to upload.');
            return;
        }

        var formData = new FormData();
        formData.append('csv_file', fileInput.files[0]); // Match the PHP $_FILES key

        $.ajax({
            url: '/api/bulk-update.php', // Your PHP API endpoint
            type: 'POST',
            data: formData,
            contentType: false, // Important for FormData
            processData: false, // Important for FormData
            dataType: 'json',
            beforeSend: function() {
                $('button[type="submit"]').prop('disabled', true).text('Uploading...');
            },
            success: function(response) {
                console.log(response);
                if (response.success) {
                    alert('Upload successful! Inserted: ' + response.inserted_shipments + ', Updated: ' + response.updated_shipments);
                } else {
                    alert('Upload failed: ' + (response.error || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                alert('Error uploading file: ' + error);
            },
            complete: function() {
                $('button[type="submit"]').prop('disabled', false).text('Upload');
            }
        });
    });
});
