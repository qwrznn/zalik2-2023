<?php
include_once "dbconnect.php";
try {
    $conn->query("SET NAMES utf8mb4");
    $conn->query("SET CHARACTER SET utf8mb4");
    $conn->query("DROP TABLE IF EXISTS Users;");if ($conn->connect_error) {
        throw new Exception('Ошибка удаления таблицы Users: [' . $conn->connect_error . ']');
    }
    $conn->query("DROP TABLE IF EXISTS NewsAgency;");if ($conn->connect_error) {
        throw new Exception('Ошибка удаления таблицы NewsAgency: [' . $conn->connect_error . ']');
    }
    echo "Таблицы Users и NewsAgency удалены успешно";
    mysqli_close($conn);
} catch (Exception $e) {
    $e->getMessage();
}
