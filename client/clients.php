<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблиця клієнтів</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="client.js"></script>
</head>
<body>

<h2>Таблиця клієнтів</h2>

<!-- Форма для додавання клієнта -->
<form id="addClientForm">
    <label for="firstName">Ім'я:</label>
    <input type="text" id="firstName" name="firstName" required>
    
    <label for="lastName">Прізвище:</label>
    <input type="text" id="lastName" name="lastName" required>
    
    <label for="address">Адреса:</label>
    <input type="text" id="address" name="address" required>
    
    <label for="phoneNumber">Номер телефону:</label>
    <input type="text" id="phoneNumber" name="phoneNumber" required>
    
    <label for="taxId">ІПН:</label>
    <input type="text" id="taxId" name="taxId" required>
    <button type="button" onclick="addClient()">ДОДАТИ КЛІЄНТА</button>

    <label for="searchForClient">Пошук:</label>
    <input type="text" id="searchForClient" name="searchForClient" onkeyup="if (event.keyCode === 13) searchClient()">
    <button type="button" onclick="searchClient()">Пошук</button>
    
</form>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Прізвище</th>
            <th>Адреса</th>
            <th>Номер телефону</th>
            <th>ІПН</th>
            <th>Дія</th>
        </tr>
    </thead>
    <tbody id="clientTableBody">
        <!-- Тут буде відображуватися інформація про клієнтів -->
    </tbody>
</table>

<!-- Модальне вікно для редагування клієнтів -->
<div id="editClientModal" style="display: none;">
    <h3>Редагувати клієнта</h3>
    <form id="editClientForm">
        <input type="hidden" id="editClientId" name="editClientId">
        
        <label for="editFirstName">Ім'я:</label>
        <input type="text" id="editFirstName" name="editFirstName" required>
        
        <label for="editLastName">Прізвище:</label>
        <input type="text" id="editLastName" name="editLastName" required>
        
        <label for="editAddress">Адреса:</label>
        <input type="text" id="editAddress" name="editAddress" required>
        
        <label for="editPhoneNumber">Номер телефону:</label>
        <input type="text" id="editPhoneNumber" name="editPhoneNumber" required>
        
        <label for="editTaxId">ІПН:</label>
        <input type="text" id="editTaxId" name="editTaxId" required>
        
        <button type="button" onclick="updateClient()">Оновити клієнта</button>
        <button type="button" onclick="deleteClient()">Видалити клієнта</button>
        <button type="button" onclick="closeEditModal()">Закрити</button>
    </form>
</div>

<button>
<a href="../index.html">Повернутися на головну сторінку</a>
</button>
</body>
</html>
