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

// Search for an account
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchValue = $_GET["searchValue"];

    $sql = "SELECT * FROM account WHERE 
            id LIKE '%$searchValue%' OR
            customer_id LIKE '%$searchValue%' OR
            type LIKE '%$searchValue%' OR
            balance LIKE '%$searchValue%' OR
            opening_date LIKE '%$searchValue%' OR
            status LIKE '%$searchValue%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $accounts = array();
        while ($row = $result->fetch_assoc()) {
            $accounts[] = $row;
        }
        echo json_encode($accounts);
    } else {
        echo json_encode(array()); // Return an empty array if no matching accounts are found
    }
}

$conn->close();
?>
