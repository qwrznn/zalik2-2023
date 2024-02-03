<?php

include_once "dbconnect.php";
include_once "action.php";
if (!isset($_SESSION)) {
    session_start(); // создаем новую сессию или восстанавливаем текущую
}
include "header.php";
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav navbar-nav navbar-right">
<?php
echo "<a href='index.php'>Головна</a><br/>";

// блок отображения сообщений
$c = 0;
if (isset($_SESSION['user_login'])) {
    echo "<a href='admin_panel.php'>Увійти до адміністративної панелі</a><br/>";
    echo "<a href='action.php?action=logout'>Вийти з облікового запису</a><br/>";
} else {
    echo "<a href='autorize.php'>Увійти</a><br/>";
    echo "<a href='registration.php'>Зареєструватись</a><br/>";
}
?>
        </ul>
    </div>
</nav>
<div class="container bg-grey">
    <?php
$arr_id = getCategories();
echo "<ul>";
foreach ($arr_id as $category) {
    echo "<li><a href='category.php?category=$category'>$category</a></li>";
}
echo "</ul>";

if (isset($_GET['category'])) {
    $category = $_GET["category"];
    $row = getPost($category);

    ?>
    <div style="margin:10px; padding:5px;width:450px;background:f0f0f0;">
    <div style="color: #999999; border-bottom:1px solid #999999;padding:5px;">Назва статті: <span
            style="color: #444;font-weight: bold;"><?php echo $row['article']; ?></span></div>

            <div style="color: #999999; border-bottom:1px solid #999999;padding:5px;">Категорія: <span
            style="color: #444;font-weight: bold;"><?php echo $row['category']; ?></span></div>
    <div style="background:#fafafa;padding:5px;"><?php echo $row['message']; ?></div>
    <div style="color: #999999; border-top:1px solid #999999;padding:5px;">Опубліковано
            <?php echo $row['log'] ?></div>
    <div style="color: #999999; border-top:1px solid #999999;padding:5px;">Дата публікації: <?php echo $row['date']; ?>
    </div>
</div>
<?php
}