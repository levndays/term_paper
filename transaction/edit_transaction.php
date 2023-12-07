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

// Update transaction
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transactionID = $_POST["transactionId"];
    $fromAccountID = $_POST["fromAccountID"];
    $toAccountID = $_POST["toAccountID"];
    $description = $_POST["description"];
    $dateTime = $_POST["dateTime"];
    $amount = $_POST["amount"];
    $transactionStatus = $_POST["transactionStatus"];

    $sql = "UPDATE transaction SET 
            from_id = '$fromAccountID',
            to_id = '$toAccountID',
            description = '$description',
            datetime = '$dateTime',
            amount = '$amount',
            status = '$transactionStatus'
            WHERE id = $transactionID";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => $conn->error));
    }
}

$conn->close();
?>
