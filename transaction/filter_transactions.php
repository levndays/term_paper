<?php
$mysqli = new mysqli("localhost", "admin", "111222333123", "term_paper");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$startDateTime = $_GET['startDateTime'];
$endDateTime = $_GET['endDateTime'];
$orderBy = $_GET['orderBy'];

// Handle the case when transactionType is "All"
$transactionType = isset($_GET['transactionType']) ? $_GET['transactionType'] : '';
if ($transactionType == "All") {
    // Query for "All" case
    $sql = "SELECT * FROM transaction WHERE datetime BETWEEN '$startDateTime' AND '$endDateTime' ORDER BY $orderBy";
} else {
    // Query for other cases
    $sql = "SELECT * FROM transaction WHERE datetime BETWEEN '$startDateTime' AND '$endDateTime' AND status = '$transactionType' ORDER BY $orderBy";
}

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $transactions = array();

    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }

    echo json_encode($transactions);
} else {
    echo json_encode(array());
}

$mysqli->close();
?>
