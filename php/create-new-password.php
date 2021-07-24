<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../assets/css/login.css" />
    <link rel="stylesheet" href="../assets/css/alert-notification.css" />

    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

    <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC</title>
  </head>
  <body>
    <!-- ===== CREATE NEW PASSWORD ===== -->
    <div class="login">
      <div class="login__header">
        <h1>MYTECC ECOMMERCE SYSTEM</h1>
        <span>Reset Your Password</span>
      </div>

      <div class="login__content">
        <div class="login__img">
          <img src="../assets/img/logo MYTECC (white outline).png" alt="" />
        </div>
        <div class="login__forms">  
        <?php
        
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if(empty($selector) || empty($validator)) {
          echo "Could not validate your request!";
        }
        else {
          if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
            ?>

            <form action="../includes/reset-password.inc.php" class="reset__pwd" method="post">
              <h1 class="login__title">Reset Password</h1>

              <input type="hidden" name="selector" value="<?php echo $selector; ?>">
              <input type="hidden" name="validator" value="<?php echo $validator; ?>">
              <div class="login__box">
                <i class="bx bx-lock-alt login__icon"></i>
                <input type="password" placeholder="Password" class="login__input" name="pwd" id="user__password2"/>
                <span class="eyes__signup2" id="eyes__signup2">
                  <i class='bx bx-hide ' id="eye__hide-icon1"></i>
                  <i class='bx bx-show-alt' id="eye__show-icon1"></i>
                </span>
              </div>

              <div class="login__box">
                <i class="bx bx-lock-alt login__icon"></i>
                <input type="password" placeholder="Confirm Password" class="login__input" name="pwd-repeat" id="user__cpassword1"/>
                <span class="eyes__signup3" id="eyes__signup3">
                  <i class='bx bx-hide' id="eye__hide-icon2"></i>
                  <i class='bx bx-show-alt' id="eye__show-icon2"></i>
                </span>
              </div>

              <input type="submit" name="reset-password-submit" class="login__button1" value="Reset Password"></input>

              <div>
                <span class="login__account">want to <a href="login" class="login__signup">cancel</a> ?</span>
              </div>
            </form>

            <?php
          }
        }

        ?>
      </div>
    </div>
      <footer clas="footer">
        <div class="footer__copy">Copyrights &#169; 2021 MYTECC. All Rights Reserved.</div>
      <footer>
        
      <!-- ===== LOGIN JS ===== -->
      <script type="text/javascript" src="../assets/js/reset-password.js"></script>
   </body>
</html>
