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

// Get transaction details for editing
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $transactionID = $_GET["transactionId"];

    $sql = "SELECT * FROM transaction WHERE id = $transactionID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $transaction = $result->fetch_assoc();
        echo json_encode($transaction);
    } else {
        echo json_encode(array()); // Return an empty array if no transaction is found
    }
}

$conn->close();
?>
