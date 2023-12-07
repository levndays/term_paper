<?php
// Database connection setup
$servername = "localhost";
$username = "admin";
$password = "111222333123";
$dbname = "term_paper";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get client data from the POST request
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$phoneNumber = $_POST['phoneNumber'];
$taxId = $_POST['taxId'];

// Insert the new client into the database
$sql = "INSERT INTO client (first_name, last_name, address, phone_number, tax_id) VALUES ('$firstName', '$lastName', '$address', '$phoneNumber', '$taxId')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Registration successful!'); window.location.href = '../index.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
