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

// Search for a transaction
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchValue = $_GET["searchValue"];

    $sql = "SELECT * FROM transaction WHERE 
            id LIKE '%$searchValue%' OR
            from_id LIKE '%$searchValue%' OR
            to_id LIKE '%$searchValue%' OR
            description LIKE '%$searchValue%' OR
            datetime LIKE '%$searchValue%' OR
            amount LIKE '%$searchValue%' OR
            status LIKE '%$searchValue%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $transactions = array();
        while ($row = $result->fetch_assoc()) {
            $transactions[] = $row;
        }
        echo json_encode($transactions);
    } else {
        echo json_encode(array()); // Return an empty array if no matching transactions are found
    }
}

$conn->close();
?>
