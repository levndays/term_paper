
// Function to fetch available customer IDs and populate the dropdown menus
function fetchCustomerIDs() {
    $.ajax({
        url: 'fetch_customer_ids.php', // Create a new PHP file for this (see below)
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the dropdown menus with customer IDs
            var customerDropdown = $('#customerID');
            var editCustomerDropdown = $('#editCustomerID');

            $.each(data, function(index, customerID) {
                customerDropdown.append('<option value="' + customerID + '">' + customerID + '</option>');
                editCustomerDropdown.append('<option value="' + customerID + '">' + customerID + '</option>');
            });
        },
        error: function(error) {
            console.error('Error fetching customer IDs:', error);
        }
    });
}

// Call the fetchCustomerIDs function when the page loads
$(document).ready(function() {
    fetchCustomerIDs();
});

// Function to delete an account
function deleteAccount() {
    var accountId = $('#editAccountId').val();

    // Send data to the server to delete the account
    $.ajax({
        url: 'delete_account.php', // Replace with the actual server-side script
        type: 'POST',
        data: { accountId: accountId },
        success: function(response) {
            // Close the edit account modal
            closeEditModal();

            // Refresh the account table after deleting the account
            fetchAccountData();
        },
        error: function(error) {
            console.error('Error deleting account:', error);
        }
    });
}

// Function to search for an account by ID or customer ID
function searchAccount() {
    var searchValue = $('#searchForAccount').val();

    // Send data to the server to search for the account
    $.ajax({
        url: 'search_account.php', // Replace with the actual server-side script
        type: 'GET',
        data: { searchValue: searchValue },
        dataType: 'json',
        success: function(data) {
            // Populate the table with search results
            $('#accountTableBody').empty(); // Clear existing data
            $.each(data, function(index, account) {
                $('#accountTableBody').append(`
                    <tr>
                        <td>${account.id}</td>
                        <td>${account.customer_id}</td>
                        <td>${account.type}</td>
                        <td>${account.balance}</td>
                        <td>${account.opening_date}</td>
                        <td>${account.status}</td>
                        <td>
                            <button type="button" onclick="openEditModal(${account.id})">Edit</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function(error) {
            console.error('Error searching for account:', error);
        }
    });
}

// Function to add a new account
function addAccount() {
    var formData = {
        customerID: $('#customerID').val(),
        accountType: $('#accountType').val(),
        balance: $('#balance').val(),
        openingDate: $('#openingDate').val(),
        accountStatus: $('#accountStatus').val(),
    };

    // Send data to the server to add a new account
    $.ajax({
        url: 'add_account.php', // Replace with the actual server-side script
        type: 'POST',
        data: formData,
        success: function(response) {
            // Refresh the account table after adding a new account
            fetchAccountData();
        },
        error: function(error) {
            console.error('Error adding account:', error);
        }
    });
}

// Function to fetch account data from the server
function fetchAccountData() {
    $.ajax({
        url: 'fetch_accounts.php', // Replace with the actual server-side script
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the table with account data
            $('#accountTableBody').empty(); // Clear existing data
            $.each(data, function(index, account) {
                $('#accountTableBody').append(`
                    <tr>
                        <td>${account.id}</td>
                        <td>${account.customer_id}</td>
                        <td>${account.type}</td>
                        <td>${account.balance}</td>
                        <td>${account.opening_date}</td>
                        <td>${account.status}</td>
                        <td>
                            <button type="button" onclick="openEditModal(${account.id})">Edit</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function(error) {
            console.error('Error fetching account data:', error);
        }
    });
}

// Function to open the edit account modal
function openEditModal(accountId) {
    // Fetch account details for the selected account
    $.ajax({
        url: 'get_account.php', // Create a new PHP file for this (see below)
        type: 'GET',
        data: { accountId: accountId },
        dataType: 'json',
        success: function(account) {
            // Populate the edit account modal with account data
            $('#editAccountId').val(account.id);
            $('#editCustomerID').val(account.customer_id);
            $('#editAccountType').val(account.type);
            $('#editBalance').val(account.balance);
            $('#editOpeningDate').val(account.opening_date);
            $('#editAccountStatus').val(account.status);

            // Display the edit account modal
            $('#editAccountModal').show();
        },
        error: function(error) {
            console.error('Error fetching account details:', error);
        }
    });
}

// Function to update an existing account
function updateAccount() {
    var formData = {
        accountId: $('#editAccountId').val(),
        customerID: $('#editCustomerID').val(),
        accountType: $('#editAccountType').val(),
        balance: $('#editBalance').val(),
        openingDate: $('#editOpeningDate').val(),
        accountStatus: $('#editAccountStatus').val(),
    };

    // Send data to the server to update the account
    $.ajax({
        url: 'edit_account.php', // Create a new PHP file for this (see below)
        type: 'POST',
        data: formData,
        success: function(response) {
            // Close the edit account modal
            closeEditModal();

            // Refresh the account table after updating the account
            fetchAccountData();
        },
        error: function(error) {
            console.error('Error updating account:', error);
        }
    });
}

// Function to close the edit account modal
function closeEditModal() {
    // Clear the form fields
    $('#editAccountForm')[0].reset();

    // Hide the edit account modal
    $('#editAccountModal').hide();
}

$(document).ready(function() {
    // Fetch and display account data when the page loads
    fetchAccountData();
});