<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблиця транзакцій</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="transaction.js"></script>
</head>
<body>

<h2>Таблиця транзакцій</h2>

<div class="collapsible" onclick="toggleCollapsible('addTransactionForm')">Додати транзакцію</div>
<div class="content" id="addTransactionForm">
    <form>
        <label for="fromAccountID">З облікового запису з ID:</label><select id="fromAccountID" name="fromAccountID" required></select>
        <label for="toAccountID">На обліковий запис з ID:</label><select id="toAccountID" name="toAccountID" required></select>
        <label for="description">Опис:</label><input type="text" id="description" name="description" required>
        <label for="dateTime">Дата та час:</label><input type="datetime-local" id="dateTime" name="dateTime" required>
        <label for="amount">Сума:</label><input type="text" id="amount" name="amount" required>
        <label for="transactionStatus">Статус транзакції:</label>
        <select id="transactionStatus" name="transactionStatus">
            <option value="Completed">Завершена</option>
            <option value="Canceled">Скасована</option>
            <option value="Blocked">Заблокована</option>
            <option value="Pending">Очікує</option>
        </select>
        <button type="button" onclick="addTransaction()">ДОДАТИ ТРАНЗАКЦІЮ</button>
    </form>
</div>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>З облікового запису</th>
            <th>На обліковий запис</th>
            <th>Опис</th>
            <th>Дата та час</th>
            <th>Сума</th>
            <th>Статус транзакції</th>
            <th>Дія</th>
        </tr>
    </thead>
    <tbody id="transactionTableBody"></tbody>
</table>

<div id="editTransactionModal" style="display: none;">
    <h3>Редагувати транзакцію</h3>
    <form id="editTransactionForm">
        <input type="hidden" id="editTransactionId" name="editTransactionId">
        <label for="editFromAccountID">З облікового запису з ID:</label><select id="editFromAccountID" name="editFromAccountID" required></select>
        <label for="editToAccountID">На обліковий запис з ID:</label><select id="editToAccountID" name="editToAccountID" required></select>
        <label for="editDescription">Опис:</label><input type="text" id="editDescription" name="editDescription" required>
        <label for="editDateTime">Дата та час:</label><input type="datetime-local" id="editDateTime" name="editDateTime" required>
        <label for="editAmount">Сума:</label><input type="text" id="editAmount" name="editAmount" required>
        <label for="editTransactionStatus">Статус транзакції:</label>
        <select id="editTransactionStatus" name="editTransactionStatus">
            <option value="Completed">Завершена</option>
            <option value="Canceled">Скасована</option>
            <option value="Blocked">Заблокована</option>
            <option value="Pending">Очікує</option>
        </select>
        <button type="button" onclick="updateTransaction()">Оновити транзакцію</button>
        <button type="button" onclick="deleteTransaction()">Видалити транзакцію</button>
        <button type="button" onclick="closeEditModal()">Закрити</button>
    </form>
</div>

<div id="sortTransactions" class="collapsible" onclick="toggleCollapsible('sortTransactionsForm')">Сортувати транзакції</div>
<div class="content" id="sortTransactionsForm">
    <form>
        <label for="startDateTime">Початкова дата та час:</label><input type="datetime-local" id="startDateTime" name="startDateTime">
        <label for="endDateTime">Кінцева дата та час:</label><input type="datetime-local" id="endDateTime" name="endDateTime">
        <label for="transactionType">Статус транзакції</label>
        <select id="transactionType" name="transactionType">
            <option value="All">Всі</option>
            <option value="Completed">Завершені</option>
            <option value="Canceled">Скасовані</option>
            <option value="Blocked">Заблоковані</option>
            <option value="Pending">Очікуючі</option>
        </select>
        <label for="orderBy">Сортувати за:</label>
        <select id="orderBy" name="orderBy">
            <option value="amount DESC">Сума (зменшення)</option>
            <option value="amount ASC">Сума (збільшення)</option>
            <option value="datetime DESC">Дата та час (зменшення)</option>
            <option value="datetime ASC">Дата та час (збільшення)</option>
        </select>
        <button type="button" onclick="sortTransactions()">Сортувати транзакції</button>
    </form>
</div>

<button type="button" onclick="goHome()">На головну</button>

</body>
</html>
