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

// Get start and end datetime from the request
$startDateTime = $_GET['startDateTime'];
$endDateTime = $_GET['endDateTime'];

// Construct the SQL query with datetime range filtering
$sql = "SELECT * FROM transaction WHERE datetime BETWEEN '$startDateTime' AND '$endDateTime' ORDER BY datetime DESC";
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
