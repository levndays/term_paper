<?php
$servername = "localhost";
$username = "admin";
$password = "111222333123";
$dbname = "term_paper";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the POST request
$clientId = $_POST['clientId'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$phoneNumber = $_POST['phoneNumber'];
$taxId = $_POST['taxId'];

// Update the client in the database
$sql = "UPDATE client SET 
        first_name = '$firstName', 
        last_name = '$lastName', 
        address = '$address', 
        phone_number = '$phoneNumber', 
        tax_id = '$taxId' 
        WHERE id = $clientId";

if ($conn->query($sql) === TRUE) {
    echo "Client updated successfully";
} else {
    echo "Error updating client: " . $conn->error;
}

$conn->close();
?>
