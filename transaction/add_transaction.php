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

// Add new transaction
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fromAccountID = $_POST["fromAccountID"];
    $toAccountID = $_POST["toAccountID"];
    $description = $_POST["description"];
    $dateTime = $_POST["dateTime"];
    $amount = $_POST["amount"];
    $transactionStatus = $_POST["transactionStatus"];

    $sql = "INSERT INTO transaction (from_id, to_id, description, datetime, amount, status) 
            VALUES ('$fromAccountID', '$toAccountID', '$description', '$dateTime', '$amount', '$transactionStatus')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => $conn->error));
    }
}

$conn->close();
?>
