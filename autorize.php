<?php
include "header.php";
include_once "action.php";
?>
<div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="text-center section-heading mb-8">
            <h2><em>З поверненням!</em></h2>
        </div>
        <div class="col-lg-3">
        </div>
        <div class="col-lg-8 align-self-center">
          <form id="contact" name='autoForm' action='autorize.php' method='post' onSubmit='return overify_login(this);'>
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="login" placeholder="Логін" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="password" name="pas" placeholder="Пароль" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" class="main-button" name='go'>Підтвердити</button>
                </fieldset>
              </div>
            </div>
          </form>
<?php
if (isset($_POST['go'])) {
    if (check_autorize($_POST['login'], $_POST['pas'])) {
        header("Location: admin_panel.php");
    } else {
        include "header.php";

        echo "Неправильне введення, спробуйте ще раз <br>";
    }
}?>
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
