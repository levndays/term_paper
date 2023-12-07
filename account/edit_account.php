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

// Update account
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountID = $_POST["accountId"];
    $customerID = $_POST["customerID"];
    $accountType = $_POST["accountType"];
    $balance = $_POST["balance"];
    $openingDate = $_POST["openingDate"];
    $accountStatus = $_POST["accountStatus"];

    $sql = "UPDATE account SET 
            customer_id = '$customerID',
            type = '$accountType',
            balance = '$balance',
            opening_date = '$openingDate',
            status = '$accountStatus'
            WHERE id = $accountID";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => $conn->error));
    }
}

$conn->close();
?>
