<?php
// Database Connection
$servername = "localhost";
$username = "admin";
$password = "111222333123";
$dbname = "term_paper";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch available customer IDs
$sql = "SELECT id FROM client";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $customerIDs = array();
    while ($row = $result->fetch_assoc()) {
        $customerIDs[] = $row['id'];
    }
    echo json_encode($customerIDs);
} else {
    echo json_encode(array()); // Return an empty array if no customer IDs are found
}

$conn->close();
?>
