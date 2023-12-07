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

// Fetch transaction data from the database
$sql = "SELECT * FROM transaction";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $transactions = array();
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
    echo json_encode($transactions);
} else {
    echo json_encode(array()); // Return an empty array if no transactions are found
}

$conn->close();
?>
