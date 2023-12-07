<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблиця рахунків</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="account.js"></script>
</head>
<body>

<h2>Таблиця рахунків</h2>

<!-- Форма додавання рахунку -->
<form id="addAccountForm">
    <label for="customerID">Ідентифікатор клієнта:</label>
    <select id="customerID" name="customerID" required></select>
    
    <label for="accountType">Тип рахунку:</label>
    <select id="accountType" name="accountType" required>
        <option value="Checking">Перевірка</option>
        <option value="Savings">Збереження</option>
        <option value="Deposit">Депозит</option>
        <option value="Credit">Кредит</option>
    </select>
    
    <label for="openingDate">Дата відкриття:</label>
    <input type="date" id="openingDate" name="openingDate" required>
    
    <label for="accountStatus">Статус рахунку:</label>
    <select id="accountStatus" name="accountStatus" required>
        <option value="Active">Активний</option>
        <option value="Closed">Закритий</option>
        <option value="Blocked">Заблокований</option>
    </select>

    <button type="button" onclick="addAccount()">ДОДАТИ РАХУНОК</button>

    <label for="searchForAccount">Пошук:</label>
    <input type="text" id="searchForAccount" name="searchForAccount" onkeyup="if (event.keyCode === 13) searchAccount()">
    <button type="button" onclick="searchAccount()">Пошук</button>
</form>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ідентифікатор клієнта</th>
            <th>Тип рахунку</th>
            <!-- Видалений стовпець балансу -->
            <th>Дата відкриття</th>
            <th>Статус рахунку</th>
            <th>Дія</th>
        </tr>
    </thead>
    <tbody id="accountTableBody">
        <!-- Тут буде відображатися інформація про рахунок -->
    </tbody>
</table>

<!-- Модальне вікно для редагування рахунків -->
<div id="editAccountModal" style="display: none;">
    <h3>Редагувати рахунок</h3>
    <form id="editAccountForm">
        <input type="hidden" id="editAccountId" name="editAccountId">
        
        <label for="editCustomerID">Ідентифікатор клієнта:</label>
        <select id="editCustomerID" name="editCustomerID" required></select>
        
        <label for="editAccountType">Тип рахунку:</label>
        <select id="editAccountType" name="editAccountType" required>
            <option value="Checking">Перевірка</option>
            <option value="Savings">Збереження</option>
            <option value="Deposit">Депозит</option>
            <option value="Credit">Кредит</option>
        </select>
        
        <!-- Видалений ввід балансу для редагування рахунку -->
        
        <label for="editOpeningDate">Дата відкриття:</label>
        <input type="date" id="editOpeningDate" name="editOpeningDate" required>
        
        <label for="editAccountStatus">Статус рахунку:</label>
        <select id="editAccountStatus" name="editAccountStatus" required>
            <option value="Active">Активний</option>
            <option value="Closed">Закритий</option>
            <option value="Blocked">Заблокований</option>
        </select>

        <button type="button" onclick="updateAccount()">Оновити рахунок</button>
        <button type="button" onclick="deleteAccount()">Видалити рахунок</button>
        <button type="button" onclick="closeEditModal()">Закрити</button>
    </form>
</div>

<button>
    <a href="../index.html">Повернутися на головну сторінку</a>
</button>
</body>
</html>
