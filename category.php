<?php

include_once "dbconnect.php";
include_once "action.php";
if (!isset($_SESSION)) {
    session_start(); // создаем новую сессию или восстанавливаем текущую
}
include "header.php";
?>

<section class="section-padding">
                <div class="container">
                    <div class="row">
                    <div class="col-lg-12 offset-lg-4">
          <div class="section-heading">
            <h2>Оберіть <span>категорію</span> новин</h2>
          </div>
        </div>

                        <?php
$arr_id = getCategories();
foreach ($arr_id as $category) {
    ?>

<div class="col-lg-2 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="category featured-block d-flex justify-content-center align-items-center">
                                <a href="category.php?category=<?php echo $category; ?>" class="d-block">
                                <img src="assets/images/<?php echo $category; ?>.png" alt="" class="featured-block-image img-fluid">
            <h6><?php echo $category; ?></h6>


                                </a>
                            </div>
                        </div>

<?php
}
if (isset($_GET['category'])) {
    ?>
<div id="services" class="our-services section">
    <div class="services-right-dec">
      <img src="assets/images/services-right-dec.png" alt="">
    </div>
    <div class="container">
      <div class="services-left-dec">
        <img src="assets/images/services-left-dec.png" alt="">
      </div>
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h6>Результати сортування за категорією: <?php echo $_GET["category"]; ?></h6>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
            <?php

    $category = $_GET["category"];
    $getPost = getPost($category);
    foreach ($getPost as $row) {
        ?>

<div class="item">
              <h4><?php echo $row['article']; ?></h4>
                <h8>Автор публікації: <?php echo $row['log'] ?></h8><div>
              <div class="icon"><img src="assets/images/<?php echo $row['category']; ?>.png" alt=""></div>
              <p><?php echo $row['message']; ?></p>
            </div>
                <div style="color: #999999; padding:5px; float: right;"><?php echo $row['date']; ?>
    </div>
</div>
<?php
}
}
?>
 </div>
      </div>
    </div>
  </div>
                    </div>
                </div>
            </section>
<?php
include "footer.php";