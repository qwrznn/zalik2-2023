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

<div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="text-center section-heading mb-8">
            <h2><em>Додати статтю</em></h2>
        </div>
        <div class="col-lg-3">
        </div>
        <div class="col-lg-8 align-self-center">
          <form id="contact" name="myForm" action="action.php" method="post" onSubmit="return overify_message(this);">
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                <input type=hidden name="action" value="add">
                <input name="article" style="width: 500px;" placeholder="Назва статті">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                <div>Категорія:</div>
                    <select name="category" style="width: 500px; border: 1px solid #9bdbf8; font-color: #2a2a2a;">
                        <option style="color: #2a2a2a;" value="Технології">Технології</option>
                        <option value="Шоу-бізнес">Шоу-бізнес</option>
                        <option value="Спорт">Спорт</option>
                        <option value="Мандрівки">Мандрівки</option>
                        <option value="Навколишнє середовище">Навколишнє середовище</option>
                        <option value="Поради">Поради</option>
                    </select>
                </fieldset><br>
              </div>
              <div class="col-lg-12">
                <fieldset>
                    <textarea style="width: 500px; height: 100px; border: 1px solid #9bdbf8;
  outline: none; color: #2a2a2a;" placeholder="Введіть текст" name="message"></textarea>
                    <div class="col-lg-12">
                </fieldset>
                </div>
                <fieldset>
                  <button type="submit" name="submitAdd" class="main-button" name='go'>Підтвердити</button>
                </fieldset>
              </div><?php
}

if (isset($_SESSION['add']) && $_SESSION['add'] == true) {
    echo "<h6>Статтю було додано успішно!</h6>";
    $_SESSION['add'] = false;
}
?>
            </div>
          </form>

        </div>
        <div class="col-lg-2">
        </div>
      </div>
    </div>
    <div class="contact-left-dec">
      <img src="assets/images/contact-left-dec.png" alt="">
    </div>
  </div>
<?php
include "footer.php";?>