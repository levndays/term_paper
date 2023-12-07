
function toggleCollapsible(id) {
    var content = document.getElementById(id);
    if (content.style.display === "none") {
        content.style.display = "block";
    } else {
        content.style.display = "none";
    }
}

function sortTransactions() {
    var startDateTime = $('#startDateTime').val();
    var endDateTime = $('#endDateTime').val();
    var transactionType = $('#transactionType').val();
    var orderBy = $('#orderBy').val();

    $.ajax({
        url: 'filter_transactions.php',
        type: 'GET',
        data: { startDateTime: startDateTime, endDateTime: endDateTime, transactionType: transactionType, orderBy: orderBy },
        dataType: 'json',
        success: function(data) {
            $('#transactionTableBody').empty();
            $.each(data, function(index, transaction) {
                // Populate the table with sorted transactions
                $('#transactionTableBody').append(`
                    <tr>
                        <td>${transaction.id}</td>
                        <td>${transaction.from_id}</td>
                        <td>${transaction.to_id}</td>
                        <td>${transaction.description}</td>
                        <td>${transaction.datetime}</td>
                        <td>${transaction.amount}</td>
                        <td>${transaction.status}</td>
                        <td>
                            <button type="button" onclick="openEditModal(${transaction.id})">Edit</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function(error) {
            console.error('Error sorting transactions:', error);
        }
    });
}

// Function to fetch available account IDs and populate the dropdown menus in the edit transaction modal
function fetchAccountIDsForEditModal() {
    $.ajax({
        url: 'fetch_account_ids.php', // Same PHP file used for the add transaction form
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the dropdown menus in the edit transaction modal with account IDs
            var editFromAccountDropdown = $('#editFromAccountID');
            var editToAccountDropdown = $('#editToAccountID');

            $.each(data, function(index, accountID) {
                editFromAccountDropdown.append('<option value="' + accountID + '">' + accountID + '</option>');
                editToAccountDropdown.append('<option value="' + accountID + '">' + accountID + '</option>');
            });
        },
        error: function(error) {
            console.error('Error fetching account IDs for edit modal:', error);
        }
    });
}

// Function to open the edit transaction modal
function openEditModal(transactionId) {
    // Fetch transaction details for the selected transaction
    $.ajax({
        url: 'get_transaction.php',
        type: 'GET',
        data: { transactionId: transactionId },
        dataType: 'json',
        success: function(transaction) {
            // Populate the edit transaction modal with transaction data
            $('#editTransactionId').val(transaction.id);
            $('#editFromAccountID').val(transaction.from_id);
            $('#editToAccountID').val(transaction.to_id);
            $('#editDescription').val(transaction.description);
            $('#editDateTime').val(transaction.datetime);
            $('#editAmount').val(transaction.amount);
            $('#editTransactionStatus').val(transaction.status);

            // Display the edit transaction modal
            $('#editTransactionModal').show();

            // Fetch and populate account IDs in the dropdown menus
            fetchAccountIDsForEditModal();
        },
        error: function(error) {
            console.error('Error fetching transaction details for edit modal:', error);
        }
    });
}



function fetchAccountIDs() {
    $.ajax({
        url: 'fetch_account_ids.php', // Create a new PHP file for this (see below)
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the dropdown menus with account IDs
            var fromAccountDropdown = $('#fromAccountID');
            var toAccountDropdown = $('#toAccountID');

            $.each(data, function(index, accountID) {
                fromAccountDropdown.append('<option value="' + accountID + '">' + accountID + '</option>');
                toAccountDropdown.append('<option value="' + accountID + '">' + accountID + '</option>');
            });
        },
        error: function(error) {
            console.error('Error fetching account IDs:', error);
        }
    });
}

// Call the fetchAccountIDs function when the page loads
$(document).ready(function() {
    fetchAccountIDs();
});

// Function to delete a transaction
function deleteTransaction() {
    var transactionId = $('#editTransactionId').val();

    // Send data to the server to delete the transaction
    $.ajax({
        url: 'delete_transaction.php', // Replace with the actual server-side script
        type: 'POST',
        data: { transactionId: transactionId },
        success: function(response) {
            // Close the edit transaction modal
            closeEditModal();

            // Refresh the transaction table after deleting the transaction
            fetchTransactionData();
        },
        error: function(error) {
            console.error('Error deleting transaction:', error);
        }
    });
}

// Function to search for a transaction by ID or description
function searchTransaction() {
    var searchValue = $('#searchForTransaction').val();

    // Send data to the server to search for the transaction
    $.ajax({
        url: 'search_transaction.php', // Replace with the actual server-side script
        type: 'GET',
        data: { searchValue: searchValue },
        dataType: 'json',
        success: function(data) {
            // Populate the table with search results
            $('#transactionTableBody').empty(); // Clear existing data
            $.each(data, function(index, transaction) {
                $('#transactionTableBody').append(`
                    <tr>
                        <td>${transaction.id}</td>
                        <td>${transaction.from_id}</td>
                        <td>${transaction.to_id}</td>
                        <td>${transaction.description}</td>
                        <td>${transaction.datetime}</td>
                        <td>${transaction.amount}</td>
                        <td>${transaction.status}</td>
                        <td>
                            <button type="button" onclick="openEditModal(${transaction.id})">Edit</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function(error) {
            console.error('Error searching for transaction:', error);
        }
    });
}

// Function to add a new transaction
function addTransaction() {
    var formData = {
        fromAccountID: $('#fromAccountID').val(),
        toAccountID: $('#toAccountID').val(),
        description: $('#description').val(),
        dateTime: $('#dateTime').val(),
        amount: $('#amount').val(),
        transactionStatus: $('#transactionStatus').val(),
    };

    // Send data to the server to add a new transaction
    $.ajax({
        url: 'add_transaction.php', // Replace with the actual server-side script
        type: 'POST',
        data: formData,
        success: function(response) {
            // Refresh the transaction table after adding a new transaction
            fetchTransactionData();
        },
        error: function(error) {
            console.error('Error adding transaction:', error);
        }
    });
}

// Function to fetch transaction data from the server
function fetchTransactionData() {
    $.ajax({
        url: 'fetch_transactions.php', // Replace with the actual server-side script
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the table with transaction data
            $('#transactionTableBody').empty(); // Clear existing data
            $.each(data, function(index, transaction) {
                $('#transactionTableBody').append(`
                    <tr>
                        <td>${transaction.id}</td>
                        <td>${transaction.from_id}</td>
                        <td>${transaction.to_id}</td>
                        <td>${transaction.description}</td>
                        <td>${transaction.datetime}</td>
                        <td>${transaction.amount}</td>
                        <td>${transaction.status}</td>
                        <td>
                            <button type="button" onclick="openEditModal(${transaction.id})">Edit</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function(error) {
            console.error('Error fetching transaction data:', error);
        }
    });
}



// Function to update an existing transaction
function updateTransaction() {
    var formData = {
        transactionId: $('#editTransactionId').val(),
        fromAccountID: $('#editFromAccountID').val(),
        toAccountID: $('#editToAccountID').val(),
        description: $('#editDescription').val(),
        dateTime: $('#editDateTime').val(),
        amount: $('#editAmount').val(),
        transactionStatus: $('#editTransactionStatus').val(),
    };

    // Send data to the server to update the transaction
    $.ajax({
        url: 'edit_transaction.php', // Create a new PHP file for this (see below)
        type: 'POST',
        data: formData,
        success: function(response) {
            // Close the edit transaction modal
            closeEditModal();

            // Refresh the transaction table after updating the transaction
            fetchTransactionData();
        },
        error: function(error) {
            console.error('Error updating transaction:', error);
        }
    });
}

// Function to close the edit transaction modal
function closeEditModal() {
    // Clear the form fields
    $('#editTransactionForm')[0].reset();

    // Hide the edit transaction modal
    $('#editTransactionModal').hide();
}

function goHome() {
    // Change 'home.html' to the actual path or URL of your home page
    window.location.href = '../index.html';
}

$(document).ready(function() {
    // Fetch and display transaction data when the page loads
    fetchTransactionData();
});