<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli("localhost", "root", "root", "registration223");

if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
} else {
    echo "Подключение к базе данных успешно!";
}

?>
