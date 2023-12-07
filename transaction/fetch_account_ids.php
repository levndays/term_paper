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

// Fetch available account IDs
$sql = "SELECT id FROM account";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $accountIDs = array();
    while ($row = $result->fetch_assoc()) {
        $accountIDs[] = $row['id'];
    }
    echo json_encode($accountIDs);
} else {
    echo json_encode(array()); // Return an empty array if no account IDs are found
}

$conn->close();
?>
