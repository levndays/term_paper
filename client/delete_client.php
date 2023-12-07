<?php
// delete_client.php

// Assuming you have a database connection
$servername = "localhost";
$username = "admin";
$password = "111222333123";
$dbname = "term_paper";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the client ID from the POST data
$clientID = $_POST['clientId'];

// SQL to delete the client
$sql = "DELETE FROM client WHERE id = $clientID";

if ($conn->query($sql) === TRUE) {
    echo "Client deleted successfully";
} else {
    echo "Error deleting client: " . $conn->error;
}

$conn->close();
?>
