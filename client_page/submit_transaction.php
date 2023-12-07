<?php
// submit_transaction.php

$servername = "localhost";
$username = "admin";
$password = "111222333123";
$dbname = "term_paper";

$your_db_connection = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sourceAccountId = $_POST['source_account_id'];
    $destinationAccountId = $_POST['destination_account_id'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    // Validate input data (add more validation as needed)

    // Perform the transaction logic and update the database
    $datetime = date("Y-m-d H:i:s"); // Current datetime
    $status = 'Completed'; // Set the status for a successful transaction

    // Insert the transaction into the database
    $insertTransactionQuery = "INSERT INTO transaction (from_id, to_id, description, datetime, amount, status) VALUES ('$sourceAccountId', '$destinationAccountId', '$description', '$datetime', '$amount', '$status')";

    if (mysqli_query($your_db_connection, $insertTransactionQuery)) {
        $response = array('success' => true, 'message' => 'Transaction added successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error adding transaction to the database: ' . mysqli_error($your_db_connection));
    }
} else {
    $response = array('success' => false, 'message' => 'Invalid request method');
}

// Close the database connection
mysqli_close($your_db_connection);

header('Content-Type: application/json');
echo json_encode($response);
?>
