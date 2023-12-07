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

// Fetch account data from the database
$sql = "SELECT * FROM account";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $accounts = array();
    while ($row = $result->fetch_assoc()) {
        $accounts[] = $row;
    }
    echo json_encode($accounts);
} else {
    echo json_encode(array()); // Return an empty array if no accounts are found
}

$conn->close();
?>
