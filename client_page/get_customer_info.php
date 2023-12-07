<?php
function getTransactions($connection, $accountId) {
    // Query to get the last 5 transactions for the given account
    $transactionQuery = "SELECT description, amount
                         FROM transaction
                         WHERE (from_id = $accountId OR to_id = $accountId)
                         ORDER BY datetime DESC
                         LIMIT 5";

    $transactionResult = mysqli_query($connection, $transactionQuery);

    $transactions = array();

    // Fetch the result as an associative array
    while ($transaction = mysqli_fetch_assoc($transactionResult)) {
        $transactions[] = $transaction;
    }

    // Free the result set
    mysqli_free_result($transactionResult);

    return $transactions;
}

?>
