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

// Fetch client data
$sql = "SELECT * FROM client";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data as JSON
    $clients = array();
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }
    echo json_encode($clients);
} else {
    echo json_encode(array());
}

$conn->close();
?>
