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

// Add new account
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerID = $_POST["customerID"];
    $accountType = $_POST["accountType"];
    $balance = $_POST["balance"];
    $openingDate = $_POST["openingDate"];
    $accountStatus = $_POST["accountStatus"];

    $sql = "INSERT INTO account (customer_id, type, balance, opening_date, status) 
            VALUES ('$customerID', '$accountType', '$balance', '$openingDate', '$accountStatus')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => $conn->error));
    }
}

$conn->close();
?>
