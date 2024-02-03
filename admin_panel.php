<?php
include_once "dbconnect.php";
ob_start();
session_start();
if (!$_SESSION['user_login']) {
    Header("Location: index.php");
    ob_end_flush();
} else {

    include "header.php";
    ob_end_flush();
    ?>
<div>
    <a href="index.php">Перегляд сайту</a>
</div>
<h3>Додати повідомлення</h3>

<form name="myForm" action="action.php" method="post" onSubmit="return overify_message(this);">
    <input type=hidden name="action" value="add">
    <div>Назва статті:</div>
    <input name="article" style="width: 300px;">
    <div>Категорія:</div>
    <select name="category">
        <option value="Технології">Технології</option>
        <option value="Шоу-бізнес">Шоу-бізнес</option>
        <option value="Спорт">Спорт</option>
        <option value="Мандрівки">Мандрівки</option>
        <option value="Навколишнє середовище">Навколишнє середовище</option>
        <option value="Поради">Поради</option>
    </select>
    <div>Повідомлення:</div>
    <textarea name="message" style="width: 300px;"></textarea>
    <div>
        <input type="submit" name="submitAdd" value="Надіслати повідомлення">
    </div>
</form>

<?php
}

if (isset($_SESSION['add']) && $_SESSION['add'] == true) {
    echo "Запис було додано успішно";
    $_SESSION['add'] = false;
}
include "footer.php";