<?php
include_once "dbconnect.php";
if (!isset($_SESSION)) {
    session_start();
}

function getPost($category)
{
    global $conn; // делаем переменную $conn глобальной
    try {
        if (!$result = $conn->query("SELECT * FROM NewsAgency JOIN users ON NewsAgency.user_id=Users.user_id WHERE category='" . $category . "' ORDER BY date DESC")) // выбор $count записей из БД, отсортированных так, что самая последняя отправленная запись будет всегда первой.
        {
            throw new Exception('Ошибка создания таблицы: [' . $conn->error . ']');
        }
        //$row = $result->fetch_assoc();
        while ($row = $result->fetch_assoc()) // каждую запись отправляем в массив.
        {
            $arr_out[] = $row;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $arr_out;
}

function getCategories()
{
    global $conn; // делаем переменную $conn глобальной
    $arr_id = array();
    try {
        if (!$result = $conn->query("SELECT category FROM Categories")) // выбор $count записей из БД, отсортированных так, что самая последняя отправленная запись будет всегда первой.
        {
            throw new Exception('Ошибка создания таблицы: [' . $conn->error . ']');
        }

        while ($row = $result->fetch_assoc()) // каждую запись отправляем в массив.
        {
            $arr_id[] = $row["category"];
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $arr_id;
}

function out($pageno, $page_size, $start)
{
    global $conn;
    $arr_out = [];
    try {
        if (!$result = $conn->query("SELECT NewsAgency.article, NewsAgency.date, NewsAgency.message, NewsAgency.category, users.log FROM NewsAgency JOIN users ON NewsAgency.user_id=users.user_id ORDER BY date DESC LIMIT $start, $page_size")) {
            throw new Exception('Error selection from table  NewsAgency: [' . $conn->error . ']');
        }
        while ($row = $result->fetch_assoc()) {
            $arr_out[] = $row;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $arr_out;
}

function check_autorize($log, $pas)
{
    global $conn;
    $sql = "SELECT log FROM Users WHERE log = '" . $log . "' AND pas='" . $pas . "';";

    if ($result = $conn->query($sql)) {
        $n = $result->num_rows;
        if ($n != 0) {
            $_SESSION['user_login'] = $log;
            return true;
        } else {
            return false;
        }
    }
}

function check_log($log)
{
    global $conn;
    try {
        $sql = "SELECT log FROM Users WHERE log = '" . $log . "'";
        $result = $conn->query($sql);
        $n = $result->num_rows;
        if ($n != 0) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        $e->getMessage();
    }
}

function registration($log, $pas)
{
    global $conn;
    $sql = "INSERT INTO Users (log, pas) VALUES (" . "'" . $log . "', " . "'" . $pas . "')";
    if (!$conn->query($sql)) {
        return false;
    } else {
        $_SESSION['user_login'] = $log;
        return true;
    }
}

function add()
{
    global $conn;

    $article = $_REQUEST['article'];
    $message = $_REQUEST['message'];
    $category = $_REQUEST['category'];
    $user_id = getIdActiveUser();
    try {
        if (!$conn->query("INSERT INTO NewsAgency(article, date, message, user_id, category) VALUES ('$article', NOW(), '$message', '$user_id', '$category')")) {
            throw new Exception('Помилка заповнення  таблиці NewsAgency: [' . $conn->error . ']');
        }

        $_SESSION['add'] = true;
        header("Location: admin_panel.php");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function getIdActiveUser()
{
    $log = $_SESSION['user_login'];
    global $conn; // делаем переменную $conn глобальной
    $user_id;
    try {
        if (!$result = $conn->query("SELECT * FROM Users WHERE log='$log'")) // выбор $count записей из БД, отсортированных так, что самая последняя отправленная запись будет всегда первой.
        {
            throw new Exception('Ошибка создания таблицы: [' . $conn->error . ']');
        }

        $row = $result->fetch_assoc();

        $user_id = $row["user_id"];

    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $user_id;
}

function logout()
{
    unset($_SESSION['user_login']);
    session_unset();
    header("Location: index.php");
}

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    switch ($action) {
        case 'add':
            add();
            break;
        case 'logout':
            logout();
            break;
        default:
            header("Location: index.php");
    }
}
