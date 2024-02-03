<?php
include "dbconnect.php";

try {
    $conn->query("SET NAMES utf8mb4");
    $conn->query("SET CHARACTER SET utf8mb4");

    if (!$conn->query("CREATE TABLE IF NOT EXISTS NewsAgency (id INT NOT NULL AUTO_INCREMENT, article VARCHAR (100), date DATETIME, message TEXT, user_id INT, category VARCHAR (100), PRIMARY KEY (id))")) {
        throw new Exception('Error creation table NewsAgency: [' . $conn->error . ']');
    }

    if (!$conn->query("CREATE TABLE  IF NOT EXISTS Users (user_id INT NOT NULL AUTO_INCREMENT, log VARCHAR(255), pas  VARCHAR(255), PRIMARY KEY (user_id))")) {
        throw new Exception('Error creation table  Users: [' . $conn->error . ']');
    }

    if (!$conn->query("CREATE TABLE IF NOT EXISTS Categories (category VARCHAR (100), PRIMARY KEY (category))")) {
        throw new Exception('Error creation table Categories: [' . $conn->error . ']');
    }

    // if (!$conn->query("INSERT INTO `categories` (`category`) VALUES ('Технології'), ('Шоу-бізнес'), ('Спорт'), ('Мандрівки'), ('Навколишнє середовище'), ('Поради')")) {
    //     throw new Exception('Error creation table  Users: [' . $conn->error . ']');
    // }

    if (!$conn->query("INSERT INTO Users (log, pas) VALUES ('pit', '123')")) {
        throw new Exception('Error creation table  Users: [' . $conn->error . ']');
    }
    if (!$conn->query("ALTER TABLE NewsAgency ADD FOREIGN KEY (user_id) REFERENCES Users (user_id)
	ON DELETE RESTRICT ON UPDATE CASCADE")) {
        throw new Exception('Ошибка создания таблицы NewsAgency: [' . $conn->error . ']');
    }

    if (!$conn->query("ALTER TABLE NewsAgency ADD FOREIGN KEY (category) REFERENCES Categories (category) ON DELETE RESTRICT ON UPDATE CASCADE")) {
        throw new Exception('Ошибка создания таблицы NewsAgency: [' . $conn->error . ']');
    }

    // INSERT INTO `newsagency` (`id`, `username`, `date`, `message`) VALUES (NULL, 'admin', NULL, 'hello');
    echo " Users, Categories and NewsAgency tables created successfully";
    $conn->close();
} catch (Exception $e) {
    echo $e->getMessage();
}
