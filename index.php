<?php
include_once "action.php";

include "header.php";
echo "<a href='index.php'>Головна</a><br/>";
echo "<a href='category.php'>Переглянути категорії постів</a><br/>";
$c = 0;
if (isset($_SESSION['user_login'])) {
    echo "<a href='admin_panel.php'>Увійти до адміністративної панелі</a><br/>";
    echo "<a href='action.php?action=logout'>Вийти з облікового запису</a><br/>";
} else {
    echo "<a href='autorize.php'>Увійти</a><br/>";
    echo "<a href='registration.php'>Зареєструватись</a><br/>";
}

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$page_size = 5;
$start = ($pageno - 1) * $page_size;

$total_pages_sql = "SELECT COUNT(*) FROM NewsAgency";
$result = mysqli_query($conn, $total_pages_sql);
$rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($rows / $page_size);
$out = out($pageno, $page_size, $start);
//$out = out(5);
//print_r($out);
if (count($out) > 0) {
    foreach ($out as $row) {

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
} else {
    echo "В гостьовій книжці поки що немає записів...<br>";
}?>

<nav aria-label="...">
<ul class="pagination">
    <li class="page-link" class="<?php if ($pageno <= 1) {echo 'disabled';}?>">
        <a href="<?php if ($pageno <= 1) {echo '#';} else {echo "?pageno=" . ($pageno - 1);}?>">Prev</a>
    </li>
        <li  class="page-item"><a class="page-link" href="?pageno=1">1</a></li>
        <li  class="page-item"><a class="page-link" href="?pageno=2">2</a></li>
        <li  class="page-item"><a class="page-link" href="?pageno=3">3</a></li>
    <li class="page-link" class="<?php if ($pageno >= $total_pages) {echo 'disabled';}?>">
        <a href="<?php if ($pageno >= $total_pages) {echo '#';} else {echo "?pageno=" . ($pageno + 1);}?>">Next</a>
    </li>
</ul>
</nav>
<?php

include "footer.php";
