<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сторінка входу</title>
    <link href="style.css" rel="stylesheet">
    <script>
        // Клієнтська функція валідації
        function validatePhoneNumber() {
            var phoneNumberInput = document.getElementById('phone_number');
            var phoneNumber = phoneNumberInput.value;

            // Регулярний вираз для правильного формату номера телефону (380XXXXXXXXX)
            var phoneRegExp = /^380\d{9}$/;

            if (!phoneRegExp.test(phoneNumber)) {
                // Повідомлення про помилку
                alert('Неправильний формат номера телефону. Будь ласка, введіть правильний номер (380XXXXXXXXX).');
                return false; // Запобігти відправці форми
            }

            return true; // Дозволити відправку форми
        }
    </script>
</head>
<body>

<div class="login-container">
    <h2>Вхід</h2>

    <?php
    // Обробка відправки форми
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Припускаючи, що ви встановили підключення до бази даних
        $servername = "localhost";
        $username = "admin";
        $password = "111222333123";
        $dbname = "term_paper";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Перевірка з'єднання
        if ($conn->connect_error) {
            die("Помилка з'єднання: " . $conn->connect_error);
        }

        // Валідація номера телефону (можливо, вам потрібна більш детальна валідація)
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

        // Перевірка, чи існує номер телефону в таблиці клієнтів
        $query = "SELECT id FROM client WHERE phone_number = '$phone_number'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Номер телефону знайдено, перенаправлення на сторінку облікового запису клієнта
            header("Location: ../client_page/index.php?phone_number=$phone_number");
            exit();
        } else {
            // Номер телефону не знайдено, виведення повідомлення про помилку
            echo '<p style="color: red;">Помилка: Номер телефону не знайдено. Будь ласка, спробуйте ще раз.</p>';
        }

        $conn->close();
    }
    ?>

    <!-- Форма входу -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validatePhoneNumber();">
        <label for="phone_number">Номер телефону:</label>
        <input type="text" name="phone_number" id="phone_number" required>
        <br><br>
        <button type="submit">Увійти</button>
    </form>
</div>

</body>
</html>
