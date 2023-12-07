<?php
// Include your database connection or any necessary setup here
// For example, if you're using PDO, you might have something like this:

// Replace the following lines with your actual database connection details
$host = 'localhost';
$dbname = 'term_paper';
$user = 'admin';
$password = '111222333123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

// Get the search value from the client-side
$searchValue = $_GET['searchValue'];

// Check if the search value is numeric (ID search) or a string (name search)
if (is_numeric($searchValue)) {
    // Perform a search by ID
    $sql = "SELECT * FROM client WHERE id = :searchValue";
} else {
    // Perform a search by first or last name
    $sql = "SELECT * FROM client WHERE first_name LIKE :searchValue OR last_name LIKE :searchValue";
    $searchValue = '%' . $searchValue . '%'; // Add wildcards for partial matches
}

// Prepare and execute the query
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
$stmt->execute();

// Fetch the results as an associative array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the results as JSON
echo json_encode($results);
?>
