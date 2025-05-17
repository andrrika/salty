<?php
session_start(); // Начинаем сессию

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Подключение к базе данных
    $mysqli = new mysqli("localhost", "root", "root", "registration223");

    if ($mysqli->connect_error) {
        die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
    }

    // Получение данных из формы
    $imya = $_POST['imya'];
    $email = $_POST['email'];
    $parol = $_POST['parol'];

    // Проверка на пустые поля
    if (empty($imya) || empty($email) || empty($parol)) {
        die("Все поля обязательны для заполнения.");
    }

    // Хеширование пароля
    $hashed_password = password_hash($parol, PASSWORD_DEFAULT);

    // Подготовленный SQL-запрос для защиты от SQL-инъекций
    $stmt = $mysqli->prepare("INSERT INTO polzovatel (imya, email, parol) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Ошибка подготовки запроса: " . $mysqli->error);
    }

    // Привязка параметров
    $stmt->bind_param("sss", $imya, $email, $hashed_password);

    // Выполнение запроса
    if ($stmt->execute()) {
        // Устанавливаем сессию с именем пользователя
        $_SESSION['username'] = $imya;

        // Редирект на главную страницу после успешной регистрации
        header("Location: Main.php");
        exit(); // Завершаем выполнение скрипта
    } else {
        echo "Ошибка при регистрации: " . $stmt->error;
    }

    // Закрытие подготовленного запроса и соединения
    $stmt->close();
    $mysqli->close();
}
?>
