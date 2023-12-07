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

// Get account details for editing
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $accountID = $_GET["accountId"];

    $sql = "SELECT * FROM account WHERE id = $accountID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $account = $result->fetch_assoc();
        echo json_encode($account);
    } else {
        echo json_encode(array()); // Return an empty array if no account is found
    }
}

$conn->close();
?>
