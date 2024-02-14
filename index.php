<?php
include_once "action.php";

include "header.php";
?>
<div class="main-banner" id="top">
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="owl-carousel owl-banner">
            <div class="item header-text">
              <h6>Про нас</h6>
              <h2>Вас вітає агентство <span>News Agency</span>!</h2>
              <p>Ми - команда "News Agency", і ми тут, щоб допомогти вам бути в курсі останніх світових трендів та подій.</p>
              <div class="down-buttons">
                <div class="main-blue-button-hover">
                  <a href="#services">Почати!</a>
                </div>

              </div>
            </div>
            <div class="item header-text">
              <h6>Наша місія</h6>
              <h2>Швидка і об'єктивна інформація<em> для всіх</em></h2>
              <p>Залишайтеся у курсі найсвіжіших новин з усіх куточків світу. Ми ретельно відбираємо, шукаємо та аналізуємо найцікавіші і найактуальніші новини, щоб надати вам повний огляд подій на планеті. </p>
              <div class="down-buttons">
                <div class="main-blue-button-hover">
                  <a href="#services">Почати!</a>
                </div>

              </div>
            </div>
            <div class="item header-text">
              <h6>Наші новини</h6>
              <h2><em>Категорії</em> для різних смаків наших <span>читачів</span></h2>
              <p>Ми пропонуємо широкий спектр новин на будь-який смак. Незалежно від вашого захоплення, ви знайдете щось цікаве для себе в наших статтях.</p>
              <div class="down-buttons">
                <div class="main-blue-button-hover">
                  <a href="#services">Почати!</a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div id="services" class="our-services section">
    <div class="services-right-dec">
      <!-- <img src="assets/images/services-right-dec.png" alt=""> -->
    </div>
    <div class="container">
      <div class="services-left-dec">
        <!-- <img src="assets/images/services-left-dec.png" alt=""> -->
      </div>
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h2>Найсвіжіші <em>новини</em> для <span>Вас</span></h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">

<?php

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



<div class="item">
              <h4><?php echo $row['article']; ?></h4>
                <h8>Автор публікації: <?php echo $row['log'] ?></h8><div>
                <div class="icon">                <a href="category.php?category=<?php echo $row['category']; ?>"><img src="assets/images/<?php echo $row['category']; ?>.png" alt=""></a></div>
              <p><?php echo $row['message']; ?></p>
            </div>
                <div style="color: #999999; padding:5px; float: right;"><?php echo $row['date']; ?>
    </div>
</div>

<?php
}
} else {
    echo "<h6>Поки що новин немає...</h6>";
}
?>
        </div>
      </div>
    </div>
  </div>

  <nav aria-label="...">
  <ul class="pagination justify-content-center">
    <li  class="page-item <?php if ($pageno <= 1) {echo "disabled";}?>" >
      <a class="page-link" tabindex="-1" href='<?php if ($pageno <= 1) {echo '#';} else {echo "index.php?pageno=" . ($pageno - 1);}?>'>Попередня</a>
    </li>

<li class="page-item <?php if (!isset($_GET["pageno"]) || $_GET["pageno"] == 1) {echo "active";}?>" aria-current="page">
<a class="page-link" href="index.php?pageno=1">1</a>
</li>
    <?php
for ($pageno = 2; $pageno <= $total_pages; $pageno++) {
    ?>
      <li class="page-item <?php if (isset($_GET["pageno"]) && $_GET["pageno"] == $pageno) {echo "active";}?>" aria-current="page">
        <a class="page-link" href="index.php?pageno=<?php echo $pageno ?>"><?php echo $pageno ?></a>
      </li>
    <?php
}?>
       <li class="page-item <?php if (isset($_GET["pageno"]) && $_GET['pageno'] >= $total_pages) {echo "disabled";}?>">
      <a class="page-link"  href="<?php
if (!isset($_GET["pageno"])) {echo "index.php?pageno=2";} elseif ($_GET['pageno'] >= $total_pages) {echo '#';} else {echo "index.php?pageno=" . ($_GET['pageno'] + 1);}?>">Наступна</a>
    </li>
  </ul>
</nav>
<hr>
<?php

include "footer.php";
