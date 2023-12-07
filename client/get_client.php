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

// Get client ID from the GET request
$clientId = $_GET['clientId'];

// Fetch client data
$sql = "SELECT * FROM client WHERE id = $clientId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data as JSON
    $client = $result->fetch_assoc();
    echo json_encode($client);
} else {
    echo json_encode(array()); // Return an empty array if no data found
}

$conn->close();
?>
