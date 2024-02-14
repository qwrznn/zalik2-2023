<?php
include_once "action.php";
include "header.php";
?>
<div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="text-center section-heading mb-8">
            <h2><em>Зареєструйтеся на нашому сайті!</em></h2>
        </div>
        <div class="col-lg-3">
        </div>
        <div class="col-lg-8 align-self-center">
          <form id="contact" name='autoForm'  action='registration.php' method='post' onSubmit='return overify_login(this);'>
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                    <input type='text' placeholder="Логін" name='login'>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                <input type='password' placeholder="Пароль" name='pas'>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" class="main-button" name='go' name='go' >Підтвердити</button>
                </fieldset>
              </div>
              <?php
if (isset($_POST['go'])) {
    if (!check_log($_POST['login'])) {
        if (registration($_POST['login'], $_POST['pas'])) {
            header("Location: index.php");
        }
    } else {
        echo "Користувач із таким ім'ям вже існує!";
    }}?>
            </div>
          </form>
        </div>
        <div class="col-lg-2">
        </div>
      </div>
    </div>
    <div class="contact-dec">
      <img src="assets/images/contact-dec.png" alt="">
    </div>
    <div class="contact-left-dec">
      <img src="assets/images/contact-left-dec.png" alt="">
    </div>
  </div>

<?php

include "footer.php";
