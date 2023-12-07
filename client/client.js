
// Function to delete a client
function deleteClient() {
    var clientId = $('#editClientId').val();

    // Send data to the server to delete the client
    $.ajax({
        url: 'delete_client.php', // Replace with the actual server-side script
        type: 'POST',
        data: { clientId: clientId },
        success: function(response) {
            // Close the edit client modal
            closeEditModal();

            // Refresh the client table after deleting the client
            fetchClientData();
        },
        error: function(error) {
            console.error('Error deleting client:', error);
        }
    });
}

// Function to search for a client by ID or first/last name
function searchClient() {
    var searchValue = $('#searchForClient').val();

    // Send data to the server to search for the client
    $.ajax({
        url: 'search_client.php', // Replace with the actual server-side script
        type: 'GET',
        data: { searchValue: searchValue },
        dataType: 'json',
        success: function(data) {
            // Populate the table with search results
            $('#clientTableBody').empty(); // Clear existing data
            $.each(data, function(index, client) {
                $('#clientTableBody').append(`
                    <tr>
                        <td>${client.id}</td>
                        <td>${client.first_name}</td>
                        <td>${client.last_name}</td>
                        <td>${client.address}</td>
                        <td>${client.phone_number}</td>
                        <td>${client.tax_id}</td>
                        <td>
                            <button type="button" onclick="openEditModal(${client.id})">Edit</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function(error) {
            console.error('Error searching for client:', error);
        }
    });
}


// Function to add a new client
function addClient() {
    var formData = {
        firstName: $('#firstName').val(),
        lastName: $('#lastName').val(),
        address: $('#address').val(),
        phoneNumber: $('#phoneNumber').val(),
        taxId: $('#taxId').val(),
    };

    // Send data to the server to add a new client
    $.ajax({
        url: 'add_client.php', // Replace with the actual server-side script
        type: 'POST',
        data: formData,
        success: function(response) {
            // Refresh the client table after adding a new client
            fetchClientData();
        },
        error: function(error) {
            console.error('Error adding client:', error);
        }
    });
}

// Function to fetch client data from the server
function fetchClientData() {
    $.ajax({
        url: 'fetch_clients.php', // Replace with the actual server-side script
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the table with client data
            $('#clientTableBody').empty(); // Clear existing data
            $.each(data, function(index, client) {
                $('#clientTableBody').append(`
                    <tr>
                        <td>${client.id}</td>
                        <td>${client.first_name}</td>
                        <td>${client.last_name}</td>
                        <td>${client.address}</td>
                        <td>${client.phone_number}</td>
                        <td>${client.tax_id}</td>
                        <td>
                            <button type="button" onclick="openEditModal(${client.id})">Edit</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function(error) {
            console.error('Error fetching client data:', error);
        }
    });
}

// Function to open the edit client modal
function openEditModal(clientId) {
    // Fetch client details for the selected client
    $.ajax({
        url: 'get_client.php', // Create a new PHP file for this (see below)
        type: 'GET',
        data: { clientId: clientId },
        dataType: 'json',
        success: function(client) {
            // Populate the edit client modal with client data
            $('#editClientId').val(client.id);
            $('#editFirstName').val(client.first_name);
            $('#editLastName').val(client.last_name);
            $('#editAddress').val(client.address);
            $('#editPhoneNumber').val(client.phone_number);
            $('#editTaxId').val(client.tax_id);

            // Display the edit client modal
            $('#editClientModal').show();
        },
        error: function(error) {
            console.error('Error fetching client details:', error);
        }
    });
}

// Function to update an existing client
function updateClient() {
    var formData = {
        clientId: $('#editClientId').val(),
        firstName: $('#editFirstName').val(),
        lastName: $('#editLastName').val(),
        address: $('#editAddress').val(),
        phoneNumber: $('#editPhoneNumber').val(),
        taxId: $('#editTaxId').val(),
    };

    // Send data to the server to update the client
    $.ajax({
        url: 'edit_client.php', // Create a new PHP file for this (see below)
        type: 'POST',
        data: formData,
        success: function(response) {
            // Close the edit client modal
            closeEditModal();

            // Refresh the client table after updating the client
            fetchClientData();
        },
        error: function(error) {
            console.error('Error updating client:', error);
        }
    });
}

// Function to close the edit client modal
function closeEditModal() {
    // Clear the form fields
    $('#editClientForm')[0].reset();

    // Hide the edit client modal
    $('#editClientModal').hide();
}

$(document).ready(function() {
    // Fetch and display client data when the page loads
    fetchClientData();
});