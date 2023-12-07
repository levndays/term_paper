<?php

function connectToDatabase() {
    $servername = "localhost";
    $username = "admin";
    $password = "111222333123";
    $dbname = "term_paper";

    return mysqli_connect($servername, $username, $password, $dbname);
}

function validatePhoneNumber($phoneNumber) {
    return preg_match('/^\d{12}$/', $phoneNumber);
}

function getClientInfo($connection, $phoneNumber) {
    $query = "SELECT c.id, c.first_name, c.last_name, a.id AS account_id, a.type, a.balance
              FROM client c
              LEFT JOIN account a ON c.id = a.customer_id
              WHERE c.phone_number = ?";

    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, "s", $phoneNumber);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    $clientInfo = array();
    $accountInfo = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $clientInfo = $row;
        $accountInfo[] = array(
            'account_id' => $row['account_id'],
            'type' => $row['type'],
            'balance' => $row['balance'],
            'transactions' => getTransactions($connection, $row['account_id']),
        );
    }

    mysqli_stmt_close($statement);

    return array($clientInfo, $accountInfo);
}

function getTransactions($connection, $accountId) {
    $transactionQuery = "SELECT description, amount
                         FROM transaction
                         WHERE (from_id = $accountId OR to_id = $accountId)
                         ORDER BY datetime DESC
                         LIMIT 5";

    $transactionResult = mysqli_query($connection, $transactionQuery);

    $transactions = array();

    while ($transaction = mysqli_fetch_assoc($transactionResult)) {
        $transactions[] = $transaction;
    }

    mysqli_free_result($transactionResult);

    return $transactions;
}

// Main logic
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['phone_number'])) {
    $phoneNumber = $_GET['phone_number'];
    $your_db_connection = connectToDatabase();

    if (!validatePhoneNumber($phoneNumber)) {
        echo 'Invalid phone number';
    } else {
        list($clientInfo, $accountInfo) = getClientInfo($your_db_connection, $phoneNumber);

        if (!empty($accountInfo)) {
            echo "<p>Greetings, {$clientInfo['first_name']} {$clientInfo['last_name']}!</p>";

            foreach ($accountInfo as $account) {
                // Display account information...

                // Display last 5 transactions...
                
                // Display form and button...
            }
        } else {
            echo "<p>No client information found for the given phone number</p>";
        }
    }

    mysqli_close($your_db_connection);
}

?>
