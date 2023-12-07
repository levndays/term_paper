<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Інформація про клієнта</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container">
<h2>Інформація про клієнта</h2>

<?php
function getTransactions($connection, $accountId) {
    // Запит для отримання останніх 5 транзакцій для заданого облікового запису
    $transactionQuery = "SELECT t.id, t.description, t.amount, t.datetime, c.first_name as sender_name, c2.first_name as receiver_name
                         FROM transaction t
                         LEFT JOIN account a1 ON t.from_id = a1.id
                         LEFT JOIN account a2 ON t.to_id = a2.id
                         LEFT JOIN client c ON a1.customer_id = c.id
                         LEFT JOIN client c2 ON a2.customer_id = c2.id
                         WHERE (a1.id = $accountId OR a2.id = $accountId)
                         ORDER BY t.datetime DESC
                         LIMIT 5";

    $transactionResult = mysqli_query($connection, $transactionQuery);

    $transactions = array();

    // Отримання результату у вигляді асоціативного масиву
    while ($transaction = mysqli_fetch_assoc($transactionResult)) {
        $transactions[] = $transaction;
    }

    // Звільнення набору результатів
    mysqli_free_result($transactionResult);

    return $transactions;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['phone_number'])) {
    $phoneNumber = $_GET['phone_number'];

    $servername = "localhost";
    $username = "admin";
    $password = "111222333123";
    $dbname = "term_paper";

    $your_db_connection = mysqli_connect($servername, $username, $password, $dbname);

    // Валідація номера телефону (можливо, вам потрібна більш детальна валідація)
    if (!preg_match('/^\d{12}$/', $phoneNumber)) {
        echo 'Неправильний номер телефону';
    } else {
        // Запит для отримання інформації про клієнта на підставі номера телефону
        $query = "SELECT c.id, c.first_name, c.last_name, a.id AS account_id, a.type, a.balance
                  FROM client c
                  LEFT JOIN account a ON c.id = a.customer_id
                  WHERE c.phone_number = '$phoneNumber'";

        $result = mysqli_query($your_db_connection, $query);

        // Перевірка успішності запиту
        if ($result) {
            $clientInfo = array(); // Для зберігання інформації про клієнта
            $accountInfo = array(); // Для зберігання інформації про обліковий запис
            $totalBalance = 0; // Для зберігання загального балансу

            // Отримання результату у вигляді асоціативного масиву
            while ($row = mysqli_fetch_assoc($result)) {
                $clientInfo = $row;
                $accountInfo[] = array(
                    'account_id' => $row['account_id'],
                    'type' => $row['type'],
                    'balance' => $row['balance'],
                    'transactions' => getTransactions($your_db_connection, $row['account_id']),
                );

                // Додавання балансу до загального
                $totalBalance += $row['balance'];
            }

            // Виведення інформації про клієнта
            echo "<p>Вітаємо, {$clientInfo['first_name']} {$clientInfo['last_name']}!</p>";

             // Виведення інформації про кожен обліковий запис
             foreach ($accountInfo as $account) {
                echo '<div class="account-box">';
                echo "<p>Тип облікового запису: {$account['type']}</p>";
                echo "<p>Баланс: {$account['balance']}</p>";

                // Виведення останніх 5 транзакцій
                if (!empty($account['transactions'])) {
                    echo "<p>Останні 5 транзакцій:</p>";
                    echo "<ul class='transaction-list'>";
                    foreach ($account['transactions'] as $transaction) {
                        $transactionType = ($transaction['id'] == $account['account_id']) ? '-' : '+';
                        echo "<li class='transaction-item'>{$transaction['receiver_name']} | $transactionType{$transaction['amount']} | {$transaction['description']} | " . date('M j, Y H:i:s', strtotime($transaction['datetime'])) . "</li>";
                    }
                    echo "</ul>";
                }

                // Додавання HTML-форми для створення транзакцій
                echo '<form class="transaction-form" id="transactionForm' . $account['account_id'] . '">';
                echo '<input type="hidden" name="source_account_id" value="' . $account['account_id'] . '">';
                echo '<label for="destination_account_id">ID облікового запису отримувача:</label>';
                echo '<input type="text" name="destination_account_id" required>';
                echo '<label for="amount">Сума:</label>';
                echo '<input type="text" name="amount" required>';
                echo '<label for="description">Опис транзакції:</label>';
                echo '<input type="text" name="description" required>';
                echo '<button type="button" onclick="submitTransactionForm(' . $account['account_id'] . ')">Відправити транзакцію</button>';
                echo '</form>';

                // Кнопка для переключення форми транзакцій
                echo '<button onclick="toggleTransactionForm(' . $account['account_id'] . ')">Створити транзакцію</button>';
                echo '</div>';
            }

            // Виведення загального балансу
            echo "<p class='total-balance'>Загальний баланс: $totalBalance</p>";

        } else {
            // Обробка помилки запиту
            echo "<p>Помилка виконання запиту: " . mysqli_error($your_db_connection) . "</p>";
        }

        // Звільнення набору результатів
        mysqli_free_result($result);

        // Закриття з'єднання з базою даних
        mysqli_close($your_db_connection);
    }
}
?>

<button onclick="goToIndex()">Вихід</button>
</div>
</body>
</html>
